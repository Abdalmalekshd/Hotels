<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class DeleteReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deletereservation:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Unconfirmed Reservations after 48 Hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $Reservation=Reservation::where('status',0)->where('created_at','<', today()->addDay())->delete();


    }
}
