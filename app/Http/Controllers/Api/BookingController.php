<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function reschedule(Request $request){

        // validate inputs 

        // check if current time is 30 minutes before the recent scheduled time

        // Update booking status to Rescheduled

        // store the reason of rescheduling the session

            // check if reason is others specify, this means that it is an open ended answer

            // if true, then validate if the reason is not empty

            // then store reason to specify other reasons table
        


    }
}
