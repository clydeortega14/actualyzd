<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PastDueBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Must send notification message to alert the psychologist about the session that has not been closed';

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
        // must send and email to each an every psychologist that hasn't completed / closed the session / booking;
    }
}
