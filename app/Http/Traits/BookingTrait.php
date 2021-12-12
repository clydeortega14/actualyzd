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
use App\User;

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

        if(!auth()->user()->hasRole('superadmin')){

            $bookings->whereNotNull('counselee');
        }

        // query bookings according to auth user role
        $this->queryByRole($bookings);
        
        // query bookings according to status
        $this->queryByStatus($bookings, $bookings);

        // with participants
        $this->withParticipants($bookings)
        ->where(function($query){
            $this->queryByStatus($query, $query);
        });

        $allBookings = $bookings->with([
            'toSchedule.psych', 
            'time',
            'sessionType',
            'toStatus',
            'reschedule',
            'cancelled.reasonOption'
        ])
        ->with(['toCounselee.progressReports' => function($query2){
            $query2->orderBy('created_at', 'desc');

        }])->latest()->paginate(10);

        return $allBookings;
	}

    public function withParticipants($query){

        return $query->orWhereHas('participants', function($query2){
            $query2->where('id', auth()->user()->id);
        });
    }

    public function countByStatus($status)
    {
        $bookings = Booking::query();

        if(!auth()->user()->hasRole('superadmin')){

            $bookings->whereNotNull('counselee');
        }

        $this->queryByRole($bookings);

        $schedules_id = $this->bookingSchedulesQuery($bookings)->pluck('id');

        if($status == 1){

            $this->withLatestBooking($bookings, $status);

        }else{
            
            $bookings->withStatus($status);
        }


        // ->where(function($query) use ($bookings, $status){
        //     $schedules_id = $this->bookingSchedulesQuery($bookings)->pluck('id');

        //     if($status == 1){

        //          $this->withLatestBooking($query, $status);

        //     }else{
                
        //         $query->withStatus($status);
        //     }

        //     $this->withLatestBooking($query, $status);
        // });

        // $this->withParticipants($bookings)
        // ->where(function($query) use ($bookings, $status){

        //     $schedules_id = $this->bookingSchedulesQuery($bookings)->pluck('id');

        //     if($status == 1){

        //          $this->withLatestBooking($query, $status);

        //     }else{
                
        //         $query->withStatus($status);
        //     }

        //     $this->withLatestBooking($query, $status);
        // });

        return $bookings->count();
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

    public function queryByRole($query)
    {
        $user = auth()->user();

        if($user->hasRole('member')){
            $query->where('booked_by', $user->id);
        }

        if($user->hasRole('psychologist')){

            $sched_id = $user->schedules->pluck('id');

            $query->whereIn('schedule', $sched_id);
        }
    }

    public function queryByStatus($query)
    {
        $schedules_id = $this->bookingSchedulesQuery()->pluck('id');

        if(request()->has('status')){
            
            if(request('status') == 1){

                $this->withLatestBooking($query, 1);

            }else{

                $query->withStatus(request('status'));

            }
            
        }else{
            // get upcoming sessions
            $this->withLatestBooking($query, 1);
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
        $statuses = BookingStatus::get(['id', 'name', 'class']);

        $by_status_with_total = [];

        foreach($statuses as $status){
            $by_status_with_total[] = [
                'id' => $status->id,
                'name' => $status->name,
                'total' => $this->countByStatus($status->id),
                'class' => $status->class
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


    protected function queryBooking()
    {
        return Booking::query();
    }

    protected function withLatestBooking($query, $status)
    {
        return $query->withStatus($status)->whereIn('schedule', $this->bookingSchedulesQuery()->pluck('id'));
    }
}
