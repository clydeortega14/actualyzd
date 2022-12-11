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

class SchedulesController extends Controller
{
    use CarbonTrait, SchedulesTrait;

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

        $time_lists = TimeList::has('schedules')
                            ->select(
                                'time_lists.from as time_from',
                                'time_lists.to as time_to',
                                'time_lists.id as time_id'
                            )
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
