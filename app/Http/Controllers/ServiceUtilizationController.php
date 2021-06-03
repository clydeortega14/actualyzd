<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientSubscription;
use App\SessionType;
use App\Booking;
use App\Http\Traits\CarbonTrait;
use App\PsychologistSchedule;
use DB;

class ServiceUtilizationController extends Controller
{
    use CarbonTrait;

    public function dashboard(Request $request)
    {
    	$clients = Client::where('is_active', true)->has('subscription')->get(['id', 'name']);

        // check if user has role of admin
        if(auth()->user()->hasRole('admin')){

            // get services with user client id
            $services = $this->serviceWithClient(auth()->user()->client_id);

        }elseif(auth()->user()->hasRole('superadmin')){ // if user has role of superadmin

            // when user has role of client
            if($request->has('client')){

                // get services for that requested client
                $services = $this->serviceWithClient($request->client);

            }else{

                // get all services for all clients
                $services = $this->allServices();
            }
        }

    	return [

            'clients' => $clients,
            'services' => $services,
            'bookings' => $this->countBookings(),
            'consultation_summaries' => $this->manageBookings(),
            'session_type_summaries' => $this->getMtd()
        ];
    }

    public function manageBookings()
    {
        $bookings = Booking::withClient()->orderBy('created_at')->get()->groupBy(function($item){
            return $item->created_at->format('Y-m-d');
        });

        $consulation_summaries = [];

        foreach($bookings as $key => $summary){

            $consulation_summaries[] = [

                'date' => $key,
                'cancelled' => $this->countByStatus($summary, 4),
                'completed' => $this->countByStatus($summary, 2),
                'no_show' => $this->countByStatus($summary, 3),
                'rescheduled' => $this->countByStatus($summary, 5),
                'firstimers' => $summary->whereNotNull('is_firstimer')->where('is_firstimer', true)->count(),
                'repeaters' => $summary->whereNotNull('is_firstimer')->where('is_firstimer', false)->count(),
            ];
        }

        return $consulation_summaries;
    }

    public function countByStatus($booking, $status)
    {
        return $booking->where('status', $status)->count();
    }

    public function serviceWithClient($client_id)
    {
        $client_subscription = ClientSubscription::where('client_id', $client_id)
            ->with(['package.services'])
            ->first();

        return $client_subscription->package->services->map(function($service) use ($client_id, $client_subscription){

            return [
                'id' => $service->session_type_id,
                'name' => $service->sessionType->name,
                'limit' => $service->limit,
                'bookings' => $service->sessionType->bookings()->where('client_id', $client_id)->get(),
                'completion_date' => $client_subscription->completion_date
            ];

        });
    }

    public function allServices()
    {
        $session_types = SessionType::has('services')->get();

        return $session_types->map(function($session_type){
            return [
                'id' => $session_type->id,
                'name' => $session_type->name,
                'limit' => $session_type->services->sum('limit'),
                'bookings' => $session_type->bookings,
                'completion_date' => 'N/A'
            ];
        });
    }

    public function countBookings()
    {
        $bookings = Booking::withClient()->select(DB::raw('count(*) as booking_count, status'))
            ->groupBy('status')
            ->with(['toStatus'])
            ->get();


        return $bookings;
    }

    public function getMtd()
    {
        $month = now()->month;
        // $months_of_quarter = $this->getMonthsOfTheQuarter();

        $booking_schedule_id = Booking::pluck('schedule');
        // // get schedules that are booked this month
        // $quarter_schedules = PsychologistSchedule::whereIn('id', $booking_schedule_id)->get();

        // return $quarter_schedules;

        $schedules = PsychologistSchedule::whereIn('id', $booking_schedule_id)->whereMonth('start', $month)->pluck('id');

        $bookings = Booking::withClient()->whereIn('schedule', $schedules)
            ->select(DB::raw('count(*) as bookings_this_month, session_type_id'))
            ->groupBy('session_type_id')
            ->with(['sessionType'])
            ->get();

        $mapped_bookings = $bookings->map(function($booking){
            return [
                'session' => $booking->sessionType->name,
                'mtd' => $booking->bookings_this_month,
                'qtd' => 0,
                'ytd' => 0
            ];
        });

        return $mapped_bookings;

    }
}
