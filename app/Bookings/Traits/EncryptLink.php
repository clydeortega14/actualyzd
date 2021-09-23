<?php

namespace App\Bookings\Traits;

use Illuminate\Support\Str;

trait EncryptLink {

	public function encLinkToSession(){
		return config('services.meetjitsi.jit_url').md5(uniqid(rand(), true)).'@'.Str::random(64);
	}
}