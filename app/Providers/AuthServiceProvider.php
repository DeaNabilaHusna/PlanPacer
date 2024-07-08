<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\UserProject;
use App\Policies\UserProyekPolicy;
use App\Models\Project;
use App\Policies\ProyekPolicy;
use App\Models\Modul;
use App\Policies\ModulPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // UserProyek::class => UserProyekPolicy::class,
        // Project::class => ProyekPolicy::class,
        // Modul::class => ModulPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
