<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use DB;
use App\AssessmentCategory;

class ConsultationsChartController extends Controller
{
    public function getConsultations(Request $request)
    {
        
        // $bookings = Booking::select(DB::raw('count(*) as total_consulations, main_concern'),
        //                             DB::raw('SUM(main_concern) as total_main_concern'),
        //                             DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), 
        //                             DB::raw('MONTH(created_at) month'))
        //                 ->whereNotNull('main_concern')
        //                 // ->whereYear('created_at', now()->format('Y'))
        //                 ->whereYear('created_at', "2022")
        //                 ->with(['mainConcern' => function($query){
        //                     return $query->select('id', 'name');
        //                 }])
        //                 ->groupBy('month')
        //                 ->get();

        $categories = AssessmentCategory::get(['id','name']);

        $categories_data = [];

        $background_colors = [
            'rgba(51, 51, 255, 0.2)', 
            'rgba(255, 128, 0, 0.2)',
            'rgba(160, 160, 160, 0.2)',
            'rgba(143, 161, 161, 0.2)',
        ];

        $border_colors = [
            'rgba(51, 51, 255, 0.2)',
            'rgba(255, 128, 0, 0.2)',
            'rgba(160, 160, 160, 0.2)',
            'rgba(143, 161, 161, 0.2)',
        ];

        foreach($categories as $index => $category)
        {
            $categories_data[] = [

                'label' => $category->name,
                'data' => $this->queryByMonth($category), // get data base on category group by month
                'backgroundColor' => $background_colors[$index],
                'borderColor' => $border_colors[$index],
                'borderWidth' => 1
            ];
        }

        return response()->json(['success' => true, 'message' => 'Charts Data', 'data' => [
            'labels' => $categories->toArray(),
            'datasets' => $categories_data
        ]]);
    }
    public function queryByMonth($category)
    {
        $yearly_data = [];

        foreach($this->getMonthsOfTheYear() as $month_no => $month_name)
        {
            $category_query = $category->bookings()
                                // ->whereYear('created_at', now()->format('Y'))
                                ->whereYear('created_at', "2021")
                                ->whereMonth('created_at', $month_no)
                                ->get();

            $yearly_data[] = count($category_query);
        }

        return $yearly_data; 
    }


    public function getMonthsOfTheYear()
    {

        $month = [];

        for ($m=1; $m<=12; $m++) {

            // $month_number = date('Y') . "-" . date('m') . "-" . str_pad($m, 2, '0', STR_PAD_LEFT);
            $month_number = str_pad($m, 2, '0', STR_PAD_LEFT);

            $month[$month_number] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        return $month;
        
    }

    public function getDaysOfTheMonth()
    {
        $month_array = array();

        for($i = 1; $i <=  date('t'); $i++)
        {
           $month_no                 = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
           $month_name               = date('M') . " " . str_pad($i, 2, '0', STR_PAD_LEFT);
           $month_array[ $month_no ] = $month_name;
        }

        return $month_array;
    }
}
