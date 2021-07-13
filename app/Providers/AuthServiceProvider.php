<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Permission;
use App\Policies\ArticlePolicy;
use App\Policies\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Permission::class =>PermissionPolicy::class,
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

       Gate::define('VIEW_ADMIN',function (User $user){

            return $user->canDo(['VIEW_ADMIN','ADD_ARTICLES'],false);
        });
       Gate::define('VIEW_ADMIN_ARTICLES',function (User $user){
           return $user->canDo('VIEW_ADMIN_ARTICLES', false);
       });
        Gate::define('EDIT_USERS',function (User $user){
            return $user->canDo('EDIT_USERS', false);
        });


        //
    }
}
