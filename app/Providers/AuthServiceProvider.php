<?php
namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use App\Post;
use App\Comment;
use App\Location;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    /*    'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Location::class => PostPolicy::class,
    */    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::guessPolicyNamesUsing(function($modelClass)
        {
            $name = class_basename($modelClass) . 'Policy';

            return "App\\Policies\\{$name}";
        });
        
       // Gate::define('update-comment', 'App\Policies\CommentAuth@update');
    }
}
