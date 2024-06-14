<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class DeleteReservationAfterItsEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-reservation-after-its-end:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete reservation after It's end";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $Reservation=Reservation::where('reservations_end_date','<', today())->delete();

    }
}
