<?php

namespace App\Bookings\Traits;

use Illuminate\Support\Str;

trait EncryptLink {

	public function encLinkToSession(){
		return md5(uniqid(rand(), true));
	}
}