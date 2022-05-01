<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-question', function($user, $question) {
            return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function($user, $question) {
            return $user->id === $question->user_id && $question->answers_count < 1;
        });

        Gate::define('update-answer', function($user, $answer) {
            return $user->id === $answer->user_id;
        });

        Gate::define('delete-answer', function($user, $answer) {
            return $user->id === $answer->user_id;
        });

        Gate::define('mark-best-answer', function($user, $answer) {
            return $user->id === $answer->question->user_id;
        });

        Gate::define('vote-own-answer', function($user, $answer) {
            return $user->id === $answer->user_id;
        });

        Gate::define('vote-own-question', function($user, $question) {
            return $user->id === $question->user_id;
        });
    }
}
