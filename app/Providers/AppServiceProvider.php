<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vitive\ProjectManagement\Domain\Project\ProjectRepository;
use Vitive\ProjectManagement\Domain\User\UserRepository;
use Vitive\ProjectManagement\Domain\Workspace\WorkspaceRepository;
use Vitive\ProjectManagement\Infrastructure\Persistence\Eloquent\ProjectRepository as EloquentProjectRepository;
use Vitive\ProjectManagement\Infrastructure\Persistence\Eloquent\UserRepository as EloquentUserRepository;
use Vitive\ProjectManagement\Infrastructure\Persistence\Eloquent\WorkspaceRepository as EloquentWorkspaceRepository;

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
