<?php

namespace App\Console;

use App\Models\Modul;
use App\Models\Project;
use App\Notifications\ModuleDeadlineApproaching;
use App\Notifications\ProjectDeadlineApproaching;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    // }
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('statuses:update')->hourly();

        $schedule->call(function () {
            $modules = Modul::where('modul_end_date', '<=', now()->addDays(2))
                ->where('modul_end_date', '>=', now())->get();
    
            foreach ($modules as $module) {
                foreach ($module->project->users as $collaborator) {
                    $collaborator->notify(new ModuleDeadlineApproaching($module, $collaborator));
                }
            }
    
            $projects = Project::where('project_end_date', '<=', now()->addDays(2))
                ->where('project_end_date', '>=', now())->get();
    
            foreach ($projects as $project) {
                foreach ($project->users as $collaborator) {
                    $collaborator->notify(new ProjectDeadlineApproaching($project, $collaborator));
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
