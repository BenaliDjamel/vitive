<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use EntityManager;
use Vitive\projectManagement\domain\Project;
use Vitive\projectManagement\domain\ProjectRepository;
use Vitive\projectManagement\infrastructure\persistence\doctrine\ProjectRepository as DoctrineProjectRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProjectRepository::class, function(){
            return new DoctrineProjectRepository(
                app('em')
            );
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
