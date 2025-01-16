<?php

namespace App\Http\Services;

use App\SessionType;

class SessionTypeService {

    public function getIndividualSession()
    {
        return SessionType::where('name', 'Individual Session')->first();
    }

}