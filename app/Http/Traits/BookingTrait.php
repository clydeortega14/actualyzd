<?php

namespace App\Http\Traits;
use App\Booking;
use App\BookingStatus;
use DB;
use Illuminate\Support\Facades\Validator;
use App\AssessmentAnswer;
use App\PsychologistSchedule;
use App\Http\Traits\BookingSchedulesTrait;
use App\Http\Traits\SchedulesTrait;


trait BookingTrait {

    use BookingSchedulesTrait, SchedulesTrait;

    public function validateBooking(array $data)
    {
        return Validator::make($data, [

            'schedule' => ['required'],
            'time_id' => ['required'],
        ]);
    }


	public function bookingsQuery()
	{
        $bookings = Booking::query();

        // query bookings according to auth user role
        $this->queryByRole($bookings);
        // query bookings according to status
        $this->queryByStatus($bookings, $bookings);

        $allBookings = $bookings->with([
            'toSchedule.psych', 
            'time',
            'progressReport',
            'sessionType',
            'toCounselee',
            'toStatus'
        ])->get();

        return $allBookings;
	}

    public function countByStatus($status)
    {
        $bookings = Booking::query();

        $this->queryByRole($bookings);

        return $bookings->where('status', $status)->count();
    }

    public function totalBookings()
    {
        $bookings = Booking::query();

        $this->queryByRole($bookings);

        return $bookings->count();
    }
    public function bookingByStatus()
    {
        return Booking::select(DB::raw('count(*) as booking_count, status', 'schedule', 'booked_by'))
            ->where(function($query){
                $this->queryByRole($query);
            })
            ->groupBy('status')
            ->with(['toStatus'])
            ->get();
    }

    public function bookingsFoMember($user, $query)
    {
        if($user->hasRole('member')){

            $query->where('booked_by', $user->id);
        }
    }
    public function bookingsForPsychologist($user, $query)
    {
        // when user is a psychologist
        if($user->hasRole('psychologist')){

            $sched_id = $user->schedules->pluck('id');

            $query->whereIn('schedule', $sched_id);
        }
    }

    public function queryByRole($query)
    {
        $user = auth()->user();

        $this->bookingsFoMember($user, $query);

        $this->bookingsForPsychologist($user, $query);
    }

    public function queryByStatus($query, $bookings)
    {
        $schedules_id = $this->bookingSchedulesQuery($bookings)->pluck('id');

        if(request()->has('status')){
            
            if(request('status') == 1){

                $query->where('status', 1)->whereIn('schedule', $schedules_id);

            }else{

                $query->where('status', request('status'));

            }
            
        }else{
            // get upcoming sessions
            $query->where('status', 1)->whereIn('schedule', $schedules_id);
        }
    }

    public function submitAnswers($booking_id, $onboarding_answers)
    {
        foreach($onboarding_answers as $index => $value){

            if($value != null){

                AssessmentAnswer::create([
                    'booking_id' => $booking_id,
                    'category_id' => 1,
                    'questionnaire_id' => $index,
                    'answer' => $value
                ]);
            }
            
        }
    }

    public function findUpcomingSession()
    {
        // query bookings by role
        $bookings = Booking::query();
        $this->queryByRole($bookings);
        return $bookings->whereHas('toSchedule', function($query){
            $query->where('start', '>=', now()->toDateString())
            ->orWhereHas('timeSchedules.toTime', function($query2){
                $query2->where('from', '>=', now()->toTimeString());
            });
        })->where('status', 1)->first();
    }

    public function bookingStatuses()
    {
        $bookings = BookingStatus::get(['id', 'name', 'class']);

        $by_status_with_total = [];

        foreach($bookings as $booking){
            $by_status_with_total[] = [
                'id' => $booking->id,
                'name' => $booking->name,
                'total' => $this->countByStatus($booking->id),
                'class' => $booking->class
            ];
        }

        return response()->json([
            'by_status_with_total' => $by_status_with_total,
            'actions' => $this->statusActionByRole()
        ]);
    }

    public function statusActionByRole()
    {
        if(auth()->user()->hasRole('member')){
            // cancel action only
            $statuses = [
                ['id' => 4, 'name' => 'Cancel']
            ]; 
        }

        if(auth()->user()->hasRole(['psychologist', 'superadmin', 'admin'])){

            $statuses = [
                ['id' => 2, 'name' => 'Complete'],  
                ['id' => 3, 'name' => 'No Show'],  
                ['id' => 4, 'name' => 'Cancel'],  
                ['id' => 5, 'name' => 'Reschedule'],  
            ];
        }

        return $statuses;
    }
}
