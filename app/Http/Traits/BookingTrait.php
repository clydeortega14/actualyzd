<?php

namespace App\Http\Traits;
use App\Booking;
use DB;
use Illuminate\Support\Facades\Validator;
use App\AssessmentAnswer;
use App\PsychologistSchedule;

trait BookingTrait {

    public function validateBooking(array $data)
    {
        return Validator::make($data, [

            'schedule' => ['required'],
            'time_id' => ['required'],
        ]);
    }


	public function bookingsQuery()
	{
		return Booking::where(function($query){
            $this->queryByRole($query);
        })
        ->with(['progressReport'])
        ->get();
	}

    public function totalBookings()
    {
        return $this->bookingsQuery()->count();
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
        $bookings = $this->bookingsQuery();
        $schedule_id = PsychologistSchedule::select('id', 'start')->whereIn('id', $bookings->pluck('schedule'))
            ->whereDate('start', '>=', now()->toDateString())
            ->orderBy('start', 'asc')
            ->first();

        return Booking::where('schedule', $schedule_id->id)->with(['toSchedule', 'time'])->first();

        
    }
}