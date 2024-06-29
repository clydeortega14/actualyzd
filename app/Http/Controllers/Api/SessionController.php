<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PsychologistSchedule;
use App\User;
use App\Booking;
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
}
