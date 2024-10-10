<?php

namespace App\Http\Traits\BookingProcess;

trait BookingProcessTrait {

    public function checkParticipants($request)
    {
        $participants = [];

        if(session()->has('participants')){
            foreach(session('participants') as $participant){
                $participants[] = $participant;
            }
        }else{
            $participants[] = [$request->psychologist, auth()->user()->id];
        }
    }
}