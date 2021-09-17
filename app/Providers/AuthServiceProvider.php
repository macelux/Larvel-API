<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate::before(function($user , $ability){
        //     if( $user->role_id == 3)
        //     {
        //         return true;
        //     }

        // });

        Gate::define('admins' , fn() => auth()->user()->role_id == 2 or 3);
        Gate::define('sadmin' , fn() => auth()->user()->role_id ==  3);
        Gate::define('user' , fn() => auth()->user()->role_id ==  1);
        
       
      
        
        

        //
    }
}
