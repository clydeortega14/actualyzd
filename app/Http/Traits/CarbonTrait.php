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
    public function getDatesOfTheMonth()
    {
        $today = today();
        $dates = [];

        for ($i=1; $i < $today->daysInMonth + 1; $i++) { 
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }
        return $dates;
    }
    public function getMonthsOfTheQuarter()
    {
        $month = [];
        for ($m=1; $m<=12; $m++) {
             $month[] = date('m', mktime(0,0,0,$m, 1, date('Y')));
        }
        return array_chunk($month, 3)[now()->quarter - 1];
        // return array_chunk($month, 3)[2];
    }
}