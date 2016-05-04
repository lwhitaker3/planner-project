<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Note' => 'App\Policies\NotePolicy',
        'App\Task' => 'App\Policies\TaskPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\Reminder' => 'App\Policies\ReminderPolicy',
        'App\Daily_Note' => 'App\Policies\DailyPolicy',



    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
