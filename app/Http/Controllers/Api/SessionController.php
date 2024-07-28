<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PsychologistSchedule;
use App\User;
use App\Booking;
use App\BookingStatus;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function reassign(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'date' => 'required|date',
            'time_id' => 'required',
            'assignee' => 'required',
            'booking_reference' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $find_schedule = PsychologistSchedule::withStart()
                            ->withTime()
                            ->where('psychologist', $request->assignee)
                            ->first();
        
        if(is_null($find_schedule)) return response()->json(['error' => true, 'message' => 'Schedule Not Found!'], 404);

        if($find_schedule->is_booked) return response()->json(['error' => true, 'message' => 'Schedule is booked and is not available for psychologist'], 422);


        $booking = Booking::where('room_id', $request->booking_reference)->first();

        if(is_null($booking)) return response()->json(['error' => true, 'message' => 'Booking Not Found!'], 404);

        $booking->schedule = $find_schedule->id;
        $booking->save();

        return response()->json([
            'error' => false,
            'message' => 'Successfully Reassigned!',
        ], 200);
    }

    public function scheduledSessions(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if(is_null($user)) return response()->json(['error' => true, 'message' => 'user not found!'], 404);

        $user_schedules = $user->schedules()->withDateAhead()->pluck('id')->toArray();

        $pending_statuses = BookingStatus::whereIn('name', [
            'Booked', 
            'Rescheduled', 
            'Completed', 
            'No Show', 
            'Cancelled', 
            'Pending'
            ])->pluck('id')->toArray();
        

        $sessions = Booking::whereIn('status', $pending_statuses)
                        ->where(function($query) use ($user) {
                            if($user->hasRole('psychologist')){

                                $user_schedules = $user->schedules()->withDateAhead()->pluck('id')->toArray();

                                $query->whereIn('schedule', $user_schedules);
                            }

                            if($user->hasRole('member')){
                                $query->where('counselee', $user->id)
                                ->orWhere('booked_by', $user->id);
                            }

                            
                        })
                        ->with([
                            'toStatus', 
                            'toCounselee', 
                            'sessionType',
                            'time',
                            'participants' => function($query) use ($user) {
                                $query->where('id', $user->id);
                            }
                        ])->get();
        
        $formatted_sessions = $sessions->map(function($session){
            return [
                'id' => $session->room_id,
                'borderColor' => $session->toStatus->border_color,
                'backgroundColor' => $session->toStatus->background_color,
                'textColor'=> $session->toStatus->text_color,
                'title' => $session->sessionType->name,
                'start' => $session->toSchedule->start.' '.$session->time->from,
                'end' => $session->toSchedule->end.' '.$session->time->to
            ];
        });


        return response()->json($formatted_sessions);
    }
}
