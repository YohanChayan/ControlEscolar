<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('student', function(User $user) {
            return $user->role == 'student';
        });

        Gate::define('admin', function(User $user) {
            return $user->role == 'admin';
        });

        Gate::define('none', function(User $user) {
            return $user->role == 'none';
        });


        // Gate::define('student', fn(User $user) => {return $user->role == 'student';}  );
        // Gate::define('admin', fn(User $user) => {return $user->role == 'admin';}  );
        // Gate::define('no-permission', fn(User $user) => {return $user->role == 'none';}  );



        // in controller for every respective method:
            //  $this->authorize('task_create');

    }
}
