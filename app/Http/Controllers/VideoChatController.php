<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoChatController extends Controller
{
    public function index($refno)
    {
        
        
        return view('pages.video-chat.index');
    }
}
