<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Booking;
use App\Http\Traits\SchedulesTrait;
use App\RescheduledBooking;
use App\SpecifyOtherReason;

class BookingController extends Controller
{
    use SchedulesTrait;

    public function reschedule(Request $request){

        $validate_schedule = $this->validateSchedule($request->all());
        $current_booking = Booking::findOrFail($request->booking_id);

        // validate inputs
        if($validate_schedule->fails()){

            return response()->json(['success' => false, 'message' => 'Validation errors', 'data' => $validate_schedule->errors()->all() ], 422);
        }

        // check if current time is 30 minutes before the recent scheduled time
        $timeIsValidForReschedule = $this->isTimeValidForReschedule($request->all(), $current_booking);

        if(!$timeIsValidForReschedule){

            return response()->json(['success' => false, 'message' => 'Sorry, but you can only reschedule 30 minutes before the designated schedule', 'data' => [] ], 403);
        }

        $newSchedule = $this->findSchedule($request->all());

        // check if current schedule is booked
        if($newSchedule->is_booked){

            return response()->json(['success' => false, 'message' => 'Sorry but the selected schedule is not available', 'data' => [] ], 403);
        }

        DB::beginTransaction();

        try {

            // update the old schedule to available again
            $current_booking->toSchedule->update(['is_booked' => false]);

            // update old booking details to new selected schedule
            $current_booking->schedule = $newSchedule->id;
            $current_booking->time_id = $request->time_id;
            $current_booking->status = 5;
            $current_booking->save();

            // update new schedule to booked
            $newSchedule->is_booked = true;
            $newSchedule->save();

            if($current_booking){

                // check if reason_option_id is 5, this means that it is an open ended answer
                if($request->reason_option_id == 5){

                    // validate others specify field
                    $others_specify_validator = $this->validateOthers($request->all());

                    // if fails
                    if($others_specify_validator->fails()){

                        // return a validation message
                        return response()->json(['success' => false, 'message' => 'validation errors', 'data' => $others_specify_validator->errors()->all() ], 422);
                    }


                    // create new reschedule for current booking
                    $reschedule = $this->createReschedule($request->all());

                    // create specify other reason
                    SpecifyOtherReason::firstOrCreate([
                        'rescheduled_booking_id' => $reschedule->id,
                        'reason' => $request->others_specify
                    ]);


                }else{

                    // create new reschedule for current booking
                    $reschedule = $this->createReschedule($request->all());

                }
            }
            
        } catch (Exception $e) {

            DB::rollback();

            return response()->json(['sucess' => false, 'message' => $e->getMessage(), 'data' => [] ], 500);
            
        }

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Booking successfully rescheduled', 'data' => $current_booking], 200);
    }

    protected function validateSchedule(array $data){

        return Validator::make($data, [

            'date' => ['required', 'date'],
            'time_id' => ['required'],
            'psychologist_id' => ['required'],
            'reason_option_id' => ['required']

        ]);
    }

    protected function validateOthers(array $data){

        return Validator::make($data, [

            'others_specify' => ['required', 'string']

        ]);
    }

    protected function isTimeValidForReschedule(array $data, $booking){

        $now = now();

        // if date is now
        if($data['date'] == $now->toDateString()){

            // must check the time first
            // time must be 30 minutes before the recent schedule
            $current_schedule_time = $booking->time->from;
            $carbonParse = \Carbon\Carbon::parse($current_schedule_time)->subMinutes(30)->toTimeString();

            // must not proceed if the current time is not 30 minutes before the old schedule time
            if($now->toTimeString() > $carbonParse){
                
                return false;
            }

        }else{

            return true;
        }
    }

    protected function createReschedule(array $data){

        return RescheduledBooking::firstOrCreate([
            'booking_id' => $data['booking_id'],
            'updated_by' => $data['updated_by'],
            'reason_option_id' => $data['reason_option_id']
        ]);
    }
}
