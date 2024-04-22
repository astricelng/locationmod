<?php

namespace Astricelng\LocationMod\Providers;
use Astricelng\Careerform\Console\InstallLocationPackage;
use Illuminate\Support\ServiceProvider;

class LocationModServiceProvider extends ServiceProvider {

    public function boot()
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallLocationPackage::class,
            ]);
        }
    }

    public function register()
    {

    }
}

