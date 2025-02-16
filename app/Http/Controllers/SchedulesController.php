<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;
use App\TimeList;
use App\TimeSchedule;
use App\Booking;
use App\Http\Traits\CarbonTrait;
use App\Http\Traits\SchedulesTrait;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Schedules\Schedule;
use App\User;
use App\BookingStatus;

class SchedulesController extends Controller
{
    use CarbonTrait, SchedulesTrait;

    public function create(Schedule $schedule)
    {
        $schedules = $schedule->query(auth()->user())->get();

        $psychologists = User::withRole('psychologist')->get(['id', 'name']);

        return view('pages.psychologists.schedule', compact('schedules', 'psychologists'));
    }

    public function index()
    {   
    	return view('pages.psychologists.schedule');
    }
    public function show()
    {
        return view('pages.schedules.show');
    }
    public function getSchedules()
    {
        // schedules query
        $schedules = $this->schedulesQuery();

        // // map collections with unique start date
        $mapped_schedules = $schedules->map(function($item, $key){

            return [
                'id' => $item->id,
                'start' => $item->start,
                'end' => $item->end,
                'display' => 'background',
                'color' => '#6fbf7f'
            ];
        })->unique(['start'])->values()->all();
        
        return response()->json($mapped_schedules);
    }

    public function updatePending(Request $request)
    {
        $booking = Booking::where('room_id', $request->room_id)->first();

        if(is_null($booking)){
            if($request->ajax()){
                return response()->json(['error' => true, 'message' => 'Not found!'], 404);
            }

            return redirect()->back()->with('error', 'Not Found!');
        }

        $booking_status = BookingStatus::where('name', 'Booked')->first();

        if(is_null($booking_status)){
            return redirect()->back()->with('error', 'Booked Status not found!');
        }
        $booking->status = $booking_status->id;
        $booking->save();

        // must send email to counselee or session participants, indicating that the session has been a accepted
        // by the psychologist / wellness coach and is scheduled.

        return redirect()->back()->with('success', 'Session has been scheduled!');
    }

    public function storeSchedule(Request $request)
    {

        // Check if there are selected time
        if($request->has('time_lists')){

            $dates = $this->betweenDates($request->start_date, $request->end_date);

            // loop dates
            foreach($dates as $d){

                // loop time lists array
                foreach($request->time_lists as $key => $time)
                {
                    $data = [
                            'psychologist' => $request->has('psychologist') ? $request->psychologist : auth()->user()->id,
                            'start' => $d,
                            'end' => $d,
                            'time_id' => $time
                        ];

                    $schedule = PsychologistSchedule::firstOrNew($data, $data);

                    $schedule->save();
                }
            }
        }

        if($request->ajax()){

            return response()->json('Successfully Created Schedule');
        }
        
        return redirect()->back();
    }

    public function removeSchedule(PsychologistSchedule $schedule)
    {
        $schedule->delete();

        return response()->json(['success' => true, 'message' => 'Successfully Removed!', 'data' => [] ], 200);
    }

    public function timeSchedule(Request $request)
    {
        // GET User schedule according to date selected
        $schedules = PsychologistSchedule::where(function($query) use ($request){

            if(auth()->user()->hasRole('psychologist')){
                $query->where('psychologist', $this->user()->id);
            }else{

                $query->where('psychologist', $request->psychologist);

            }


        })->whereDate('start', $request->start)
            ->with([
                'timeList' => function($query){
                    $query->orderBy('from', 'asc');
                }, 
                'psych', 
                'booking.toStatus', 
                'booking.sessionType', 
                'booking.toCounselee'
            ])

            ->get();

        $time_list_query = TimeList::Query();

        if(auth()->user()->hasRole('psychologist')){

            $time_list_query->whereDoesntHave('schedules', function($query) use ($request) {

                    $query->where('psychologist', auth()->user()->id)
                        ->where('start', $request->start)->where('is_booked', false);
                });
        }

        $time_lists = $time_list_query->orderBy('from', 'asc')->get();

        // $time_lists = TimeList::whereDoesntHave('schedules', function($query) use ($request) {

        //     $query->where(function($query2){

        //         if(auth()->user()->hasRole('psychologist')){
        //             $query2->where('psychologist', auth()->user()->id);
        //         }
        //     })->where('start', $request->start)
        //     ->where('is_booked', false);
        // })
        // ->orderBy('from', 'asc')
        // ->get();

        return response()->json([
            'schedules' => $schedules,
            'time_lists' => $time_lists,
        ]);
    }

    public function psychologists($time)
    {
        $time_schedules = TimeSchedule::where('time', $time)->with(['toSchedule.psych'])->get();

        $mapped_psychologists = $time_schedules->map(function($time_schedule){

            return [

                'id' => $time_schedule->toSchedule->psych->id,
                'name' => $time_schedule->toSchedule->psych->name
            ];

        })->unique('id')->values();

        return response()->json($mapped_psychologists);
    }

    public function delete(Request $request)
    {
        PsychologistSchedule::where('id', $request->sched_id)->delete();

        return redirect()->back();
    }
    public function user()
    {
        return auth()->user();
    }

    public function getTimeBySchedule(PsychologistSchedule $schedule)
    {
        return response()->json($this->scheduleTimeQuery($schedule));
    }

    /**
     * Time By Date function
     * */

    public function timeByDate(Request $request){

        if($this->validateTimeBySchedule($request->all())->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $this->validateTimeBySchedule($request->all())->errors()->all(),
            ]);
        }

        if($request->date < now()->toDateString()){

            return response()->json([
                'success' => false,
                'message' => '',
                'data' => []
            ]);
        }

        $used_schedules = PsychologistSchedule::where('start', $request->date)->where('is_booked', true)->pluck('time_id');

        $time_lists = TimeList::select(
                                'time_lists.from as time_from',
                                'time_lists.to as time_to',
                                'time_lists.id as time_id'
                            )
                            ->where(function($query) use ($request) {

                                $new_hour = now()->addHour(config('app.hour_before_booking'));

                                if($request->date === now()->toDateString())
                                {
                                    $query->whereTime('from', '>', $new_hour->toDateTimeString());
                                }
                            })
                            ->whereNotIn('id', $used_schedules)
                            ->orderBy('from', 'asc')
                            ->get();

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $time_lists
        ]);
    }

    public function validateTimeBySchedule(array $data){

        return Validator::make($data, [

            'date' => ['required']
        ]);
    }

    public function psychologistsByDateTime(Request $request){

        $schedules = PsychologistSchedule::withStart()
                        ->withTime()
                        ->withNotBooked()
                        ->where(function($query){
                            if(auth()->user()->hasRole('psychologist')){
                                $query->whereNotIn('psychologist', [auth()->user()->id]);
                            }
                        })
                        ->with(['psych', 'timeList'])
                        ->get();

        $map_to_psychologists = $schedules->map(function($schedule){
            return [

                'id' => $schedule->psych->id,
                'name' => $schedule->psych->name
            ];
        });

        return response()->json($map_to_psychologists);
    }
}
