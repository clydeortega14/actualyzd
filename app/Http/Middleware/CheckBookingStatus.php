<?php

namespace App\Http\Middleware;

use Closure;

class CheckBookingStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null($request->status) || $request->status == ""){

            if($request->ajax()) return response()->json(['status' => false, 'message' => 'Please specify a status', 'data' => [] ]);

            return redirect()->back()->with('error', 'Please specify a status');

        }else if($request->status == 2 && $request->sessionType === 'Individual Session') return redirect()->route('progress.report.create-for-booking', $request->id);
        
        else if($request->status == 4) return redirect()->route('bookings.cancel', $request->id);

        else if($request->status == 5) return redirect()->route('booking.reschedule', $request->id);
        
        else if($request->status == 1){

            // if ($request->ajax()) return response()->json(['success' => false, 'message' => 'Not Applicable to update', 'data' => [] ]);
                
            // return redirect()->back()->with('error', 'Not Applicable to update');

        }

        return $next($request);
    }
}
