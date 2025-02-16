<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Booking;
use App\PsychologistSchedule;
use App\BookingStatus;
use Illuminate\Support\Facades\Log;

class UpdatePastdueSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pastdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the pastdue sessions to avoid conflict of sessions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pending_status = BookingStatus::where('name', 'Pending')->first();
        $now_show_status = BookingStatus::where('name', 'No Show')->first();


        if(!is_null($pending_status) && !is_null($now_show_status))
        {
            $bookings = Booking::whereHas('toSchedule', function($query){
                $query->where('start', '<', now()->toDateString());
            })
            ->where('status', $pending_status->id)
            ->update(['status' => $now_show_status->id]);

        }else{

            Log::error('Pending And No Show Statuses is not found');
        }
    }
}
