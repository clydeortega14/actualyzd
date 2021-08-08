<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\ChatMessage;
use DB;

class VideoChatController extends Controller
{
    public function index($room_id)
    {
        $booking = Booking::where('room_id', $room_id)->first();

        if(is_null($booking)){

            return redirect()->back()->with('error', 'Session has no room');
        }
        
        return view('pages.video-chat.index', compact('booking'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'message' => ['required']
        ]);

        DB::beginTransaction();

        ChatMessage::firstOrCreate([

            'booking_id' => $request->booking_id,
            'message' => $request->message,
            'created_by' => auth()->user()->id

        ]);


        DB::commit();

        return redirect()->back();

    }
}
