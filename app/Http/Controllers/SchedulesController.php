<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\PsychologistSchedule;
use App\TimeList;
use App\TimeSchedule;
use App\Http\Traits\CarbonTrait;
use App\Http\Traits\SchedulesTrait;
use Illuminate\Support\Facades\Validator;

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
        $dates = $this->betweenDates($request->start_date, $request->end_date);

        // Delete all schedules related to current psychologist and the date in the calendar selected
        // PsychologistSchedule::where('psychologist', $this->user()->id)->where('start', $request->start_date)->delete();

        $schedules = PsychologistSchedule::where('psychologist', $this->user()->id)->where('start', $request->start_date)->get();

        return $schedules;

        // Check if there are selected time
        if($request->has('time_lists')){
            // loop time lists array
            foreach($dates as $d){
                // loop time lists array
                foreach($request->time_lists as $key => $time)
                {
                    // store time schedules
                    PsychologistSchedule::firstOrCreate([
                        'psychologist' => auth()->user()->id,
                        'start' => $d,
                        'end' => $d,
                        'time_id' => $time
                    ]);
                }
            }
        }
        
        return redirect()->back();
    }

    public function timeSchedule(Request $request)
    {
        // GET User schedule according to date selected
        $schedules = PsychologistSchedule::where('psychologist', $this->user()->id)
            ->whereDate('start', $request->start)
            ->with(['timeList', 'psych', 'booking.toStatus', 'booking.sessionType', 'booking.toCounselee'])
            ->get();

        $time_lists = TimeList::with(['schedules' => function($query) use ($request){

            $query->where('psychologist', auth()->user()->id)
            ->where('start', $request->date)
            ->where('is_booked', false);

        }])
        ->orderBy('from', 'asc')
        ->get();

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
                'success' => true,
                'message' => 'Validation error',
                'data' => $this->validateTimeBySchedule($request->all())->errors()->all(),
            ]);
        }

        if($request->date < now()->toDateString()){

            return response()->json([
                'success' => true,
                'message' => '',
                'data' => []
            ]);
        }

        // pluck time list by id
        $plucked_time_id = $this->pluckedAllTime();

        $schedules = PsychologistSchedule::withStart()->where(function($query) use ($plucked_time_id, $request){

                            // if selected date is equal to current date
                            if($request->date == now()->toDateString()){

                                // must filter time_id to be display 
                                // make the time advance to 1 hour from the current time
                                $query->whereIn('time_id', $plucked_time_id);
                            }

                        })
                        ->withNotBooked()
                        ->with(['timeList'])
                        ->get()
                        ->unique(['time_id'])
                        ->values()
                        ->all();

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $schedules
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
