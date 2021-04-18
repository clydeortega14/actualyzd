<?php

namespace App\Http\Traits;
use Carbon\CarbonPeriod;

trait CarbonTrait
{
	public function betweenDates($start, $end)
	{
		$period = CarbonPeriod::create($start, $end);
        $dates = [];
        // Iterate over the period
        foreach ($period as $date) {
            // assign formatted date on dates array
            $dates[] = $date->format('Y-m-d');
        }
        // remove the last element in order to get the correct date range
        array_pop($dates);

        return $dates;
	}
}