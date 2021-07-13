<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientSubscription;
use App\SessionType;
use App\Booking;
use App\Http\Traits\CarbonTrait;
use App\Http\Traits\BookingSchedulesTrait;
use App\PsychologistSchedule;
use App\AssessmentCategory;
use DB;

class ServiceUtilizationController extends Controller
{
    use CarbonTrait, BookingSchedulesTrait;

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
            'users_experience' => $this->countUserExperience(),
            'consultation_summaries' => $this->manageBookings(),
            'session_type_summaries' => $this->getMtd(),
            'total_main_concerns' => $this->countMainConcerns(),
            'main_concerns_summarries' => $this->mainConcernSummaries(),
            'list_of_main_concerns' => $this->listOfMainConcerns(),
            'main_concerns_by_date' => $this->getMainConcerns()
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

    public function countUserExperience()
    {
        $first_timers = Booking::withClient()->where('is_firstimer', true)->count();
        $repeaters = Booking::withClient()->where('is_firstimer', false)->count();
        return [
            'first_timers' => $first_timers,
            'repeaters' => $repeaters
        ];
    }

    public function getMtd()
    {
        // get schedules that are booked this month
        $month = now()->month;
        // schedules that are booked this year
        $year = now()->year;

        $session_types = SessionType::get(['id', 'name']);

        $by_dates = [];
        foreach($session_types as $session_type){
            $by_dates[] = [
                'session' => $session_type->name,
                'mtd' => $this->countByDates($this->pluckedMonthSchedules($month), $session_type->id)->count(),
                'qtd' => 0,
                'ytd' => $this->countByDates( $this->pluckedYearSchedules($year), $session_type->id)->count()
            ];
        }
        
        return $by_dates;
    }

    public function getMainConcerns()
    {
        // get schedules that are booked this month
        $month = now()->month;
        // schedules that are booked this year
        $year = now()->year;

        $categories = $this->listOfMainConcerns();
        $main_concerns_by_date = [];

        foreach($categories as $category){
            $main_concerns_by_date[] = [
                'name' => $category->name,
                'mtd' => $this->countConcernByDates($this->pluckedMonthSchedules($month), $category->id)->count(),
                'qtd' => 0,
                'ytd' => $this->countConcernByDates($this->pluckedYearSchedules($year), $category->id)->count()
            ];
        }

        return $main_concerns_by_date;
    }

    public function countByDates($schedules, $session_type_id)
    {
         $count_by_dates = Booking::withClient()->whereIn('schedule', $schedules)
            ->where('session_type_id', $session_type_id)
            ->get();

        return $count_by_dates;
    }

    public function countConcernByDates($schedules, $main_concern)
    {
        $main_concerns = Booking::withClient()->whereIn('schedule', $schedules)
            ->where('main_concern', $main_concern)
            ->get();

        return $main_concerns;
    }

    public function countMainConcerns()
    {
        $total_main_concerns = Booking::withClient()
            ->has('mainConcern')
            ->select(DB::raw('count(main_concern) as main_concerns_count, main_concern'))
            ->groupBy('main_concern')
            ->with(['mainConcern'])
            ->get();

        return $total_main_concerns;
    }
    public function mainConcernSummaries()
    {
        $month = now()->month;
        $plucked_monthly_schedules = $this->pluckedMonthSchedules($month);
        
        $main_concerns_summaries = Booking::withClient()
            ->has('mainConcern')
            ->whereIn('schedule', $plucked_monthly_schedules)
            ->where(function($query){
                if(request()->has('main_concern')){
                    $query->where('main_concern', request('main_concern'));
                }
            })
            ->with(['toSchedule', 'mainConcern'])
            ->get();

        return $main_concerns_summaries;
    }
    public function listOfMainConcerns()
    {
        return AssessmentCategory::has('bookings')->get(['id', 'name']);
    }
}
