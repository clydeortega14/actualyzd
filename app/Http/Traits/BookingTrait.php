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
        // $this->queryByRole($bookings);

        $bookings->where(function($query){

            if(request()->has('status')){
                $query->where('status', request('status'));
            }

            // upcoming
            $query->whereIn('status', [1,5,6])
                ->whereHas('toSchedule', function($query2){
                    $query2->whereDate('start', '>=', now()->toDateString());
                });
        })
        ->where(function($query){
            $this->queryByRole($query);
        });
        
        // query bookings according to status
        // $this->queryByStatus($bookings, $bookings);

        // with participants
        $this->withParticipants($bookings)
        ->where(function($query){
            $this->queryByStatus($query, $query);
        });

        // $bookings = $this->conditionQuery();


        $allBookings = $bookings->with([
            'toSchedule.psych', 
            'time',
            'sessionType',
            'toStatus',
            'reschedule',
            'cancelled.reasonOption',
            'participants.roles'
        ])
        ->with(['toCounselee.progressReports' => function($query2){
            $query2->orderBy('created_at', 'desc');

        }])->orderBy('created_at', 'desc')->paginate(50);

        return $allBookings;
	}

    public function conditionQuery()
    {
        $bookings = Booking::query();

        if(!auth()->user()->hasRole('superadmin')){

            $bookings->whereNotNull('counselee');
        }

        $bookings->when(request()->has('status'), function($query){

            if(request('status') == 1){

                $query->whereIn('status', [1, 5])
                    ->where(function($query2){
                        $this->queryByRole($query2);
                    })
                    ->whereHas('toSchedule', function($query2){

                        $query2->where('start', '>=', now()->toDateString())
                        ->orderBy('start', 'desc');
                    });

            }else if(request('status') == 6){

                $query->whereIn('status', [1, 5])
                ->where(function($query2){
                    $this->queryByRole($query2);
                })
                ->orWhereHas('toSchedule', function($query2){
                    $query2->where('start', '>', now()->toDateString());
                });

            }else{

                $query->where('status', request('status'))
                    ->where(function($query2){
                        $this->queryByRole($query2);
                    });
            }


        }, function($query){

            $query->whereIn('status', [1, 5])
                ->where(function($query2){
                    $this->queryByRole($query2);
                })
                ->whereHas('toSchedule', function($query2){

                    $query2->where('start', '>=', now()->toDateString());
                });
        });

        return $bookings;
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

        if($status == 6 || $status == 1 || $status == 5){

            $bookings->whereIn('status', [1, 5, 6])
                ->where(function($query2){
                    $this->queryByRole($query2);
                })
                ->whereHas('toSchedule', function($query2){
                    $query2->where('start', '>=', now()->toDateString());
                });
        }else{

            $bookings->where('status', $status)
                ->where(function($query2){
                    $this->queryByRole($query2);
                });
        }

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

            $sched_id = $user->schedules->pluck('id')->toArray('id');

            $query->whereIn('schedule', $sched_id);
        }
    }

    public function queryByStatus($query)
    {
        $schedules_id = $this->bookingSchedulesQuery()->pluck('id');

        if(request()->has('status')){
            
            if(request('status') == 1){

                $query->whereIn('status', [1, 5])
                    ->whereHas('toSchedule', function($query2){
                        $query2->where('start', '>=', now()->toDateString());
                    });

            }else{

                $query->withStatus(request('status'));

            }
            
        }else{

            // get upcoming sessions
            $query->whereIn('status', [1, 5])
                ->whereHas('toSchedule', function($query2){
                    $query2->whereDate('start', '>=', now()->toDateString());
                });
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
        $statuses = BookingStatus::whereIn('name', [ 
                        'Booked', 
                        'Completed', 
                        'No Show', 
                        'Cancelled',
                        'Pending'
                    ])->get(['id', 'name', 'class']);

        $statuses_v2 = Booking::select(DB::raw('count(*) as status_count, status, id'))
                    ->whereIn('status', [2, 3, 4])
                    ->where(function($query){
                        $this->queryByRole($query);
                    })
                    ->with(['toStatus:id,name,class'])
                    ->groupBy('status')
                    ->get()->toArray();
        
        $upcoming = Booking::select(DB::raw('count(*) as status_count, status, id'))
                        ->whereIn('status', [1, 5, 6])
                        ->where(function($query){
                            $this->queryByRole($query);
                        })
                        ->whereHas('toSchedule', function($query){
                            $query->whereDate('start', '>=', now()->toDateString());
                        })
                        ->with(['toStatus:id,name,class'])
                        ->groupBy('status')
                        ->get()->toArray();

        $merged = array_merge($upcoming, $statuses_v2);

        return response()->json([
            'merged' => $merged,
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

    protected function withLatestBooking($query, $status)
    {
        return $query->withStatus($status)->whereIn('schedule', $this->bookingSchedulesQuery()->pluck('id'));
    }
}
