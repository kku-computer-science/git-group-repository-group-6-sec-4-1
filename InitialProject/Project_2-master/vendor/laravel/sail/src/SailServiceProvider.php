<?php

namespace Laravel\Sail;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Laravel\Sail\Console\AddCommand;
>>>>>>> main
use Laravel\Sail\Console\InstallCommand;
use Laravel\Sail\Console\PublishCommand;

class SailServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        $this->configurePublishing();
    }

    /**
     * Register the console commands for the package.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
<<<<<<< HEAD
=======
                AddCommand::class,
>>>>>>> main
                PublishCommand::class,
            ]);
        }
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../runtimes' => $this->app->basePath('docker'),
            ], ['sail', 'sail-docker']);

            $this->publishes([
                __DIR__ . '/../bin/sail' => $this->app->basePath('sail'),
            ], ['sail', 'sail-bin']);
<<<<<<< HEAD
=======

            $this->publishes([
                __DIR__ . '/../database' => $this->app->basePath('docker'),
            ], ['sail', 'sail-database']);
>>>>>>> main
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            InstallCommand::class,
            PublishCommand::class,
        ];
    }
}
