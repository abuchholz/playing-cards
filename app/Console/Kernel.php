<?php

namespace App\Console;

use App\Console\Commands\DropTables;
use App\Console\Commands\CustomKeyGenerate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CustomKeyGenerate::class,
        DropTables::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (!app()->env === 'production') {
            $schedule->command('backup:run --only-to-disk=local')->daily()->at('03:15');
        } else {
            $schedule->command('backup:run')->daily()->at('03:15');
        }
        $schedule->command('backup:clean')->daily()->at('03:30');
    }
}
