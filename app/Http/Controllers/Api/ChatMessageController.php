<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\ChatMessage;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Events\NewMessage;
use App\Events\VideoCallEvent;

class ChatMessageController extends Controller
{
    public function chatMessages($room_id){

        $booking = Booking::where('room_id', $room_id)->first();

        if(is_null($booking)){

            return response()->json(['error' => true, 'message' => 'Sorry, but this room does not exists'], 404);
        }

        $messages = $booking->chats()->with(['createdBy', 'booking'])->get();

        broadcast(new VideoCallEvent($booking));

        return response()->json(['error' => false, 'data' => $messages]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'message' => ['required'],

        ]);

        $validator->validate();


        DB::beginTransaction();

        $chat_message = ChatMessage::firstOrCreate([

            'booking_id' => $request->booking_id,
            'message' => $request->message,
            'created_by' => $request->created_by

        ]);


        DB::commit();


        $chat_message->load(['createdBy', 'booking']);

        broadcast(new NewMessage($chat_message))->toOthers();

        return response()->json(['error' => false, 'message' => 'success', 'data' => $chat_message ]);
    }
}
