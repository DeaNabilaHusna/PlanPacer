<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\Project;
class UpdateProjectAndModuleStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-project-and-module-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Project::all()->each(function ($project) {
            $project->updateStatus();
            $project->moduls->each(function ($modul) {
                if ($modul->modul_status !== 'selesai' && $modul->modul_end_date < now()) {
                    $modul->modul_status = 'terlambat';
                    $modul->save();
                }
            });
        });
    }
}
