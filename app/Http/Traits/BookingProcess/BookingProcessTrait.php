<?php

namespace App\Http\Traits\BookingProcess;

trait BookingProcessTrait {

    public function checkParticipants($request, $booking)
    {
        $participants = [];

        if(session()->has('participants')){
            foreach(session('participants') as $participant){
                
                $booking->participants()->attach($participant);
            }
        }else{
            $booking->participants()->attach([$request->psychologist, $request->user()->id]);
        }

        
    }
}