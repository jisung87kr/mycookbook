<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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

        Gate::define('write-post', function($user){
            return Auth::check();
        });

        Gate::define('edit-post', function($user, $post){
            return $user->id === $post->user_id;
        });

        Gate::define('write-comment', function(){
            return Auth::check();
        });

        Gate::define('edit-comment', function($user, $comment){
            return $user->id == $comment->user_id;
        });
    }
}
