<?php

namespace Pythagus\LaravelAbstractBasis;

use Illuminate\Support\Carbon;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Class Maintenance
 * @package Pythagus\LaravelAbstractBasis
 *
 * @author: Damien MOLINA
 */
class Maintenance {

    /**
     * Get the next maintenance date.
     * 
     * @return Carbon|null
     */
    public static function next() {
        $env  = env('MAINTENANCE_AT') ;
		$date = null ;

		if($env) {
			$date  = Carbon::parse($env) ;
			$limit = $date->clone()->subMinutes(30) ;

			if($date->format('Y-m-d H:i') != now()->format('Y-m-d H:i')) {
				if($date->isPast() || $limit->isFuture()) {
					$date = null ;
				}
			}
		}

		return $date ;
    }

    /**
     * Schedule the maintenance checks.
     *
     * @param Schedule $schedule
     * @return void
     */
    public static function schedule(Schedule $schedule) {
        $maintenance_date = maintenance_date() ;
		if($maintenance_date && $maintenance_date->isToday()) {
            $secret = env('MAINTENANCE_SECRET') ;

            if($secret) {
                $secret = ' --secret=' . $secret ;
            }

			$schedule->command('down' . $secret)
				->at($maintenance_date->format('H:i'))
				->evenInMaintenanceMode() ;
		}
    }
}
