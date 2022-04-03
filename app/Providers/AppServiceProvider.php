<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\domain\user\UserRepository;
use Vitive\projectManagement\domain\Workspace\WorkspaceRepository;
use Vitive\projectManagement\infrastructure\persistence\Eloquent\ProjectRepository as EloquentProjectRepository;
use Vitive\projectManagement\infrastructure\persistence\Eloquent\UserRepository as EloquentUserRepository;
use Vitive\projectManagement\infrastructure\persistence\Eloquent\WorkspaceRepository as EloquentWorkspaceRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
/*         $this->app->bind(ProjectRepository::class, function(){
            return new DoctrineProjectRepository(
                app('em')
            );
        });
        $this->app->bind(UserRepository::class, function(){
            return new DoctrineUserRepository(
                app('em')
            );
        }); */

        $this->app->bind(ProjectRepository::class, function(){
            return new EloquentProjectRepository();
        });

        $this->app->bind(UserRepository::class, function(){
            return new EloquentUserRepository();
        });

        $this->app->bind(WorkspaceRepository::class, function(){
            return new EloquentWorkspaceRepository();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
