<?php

namespace Astricelng\LocationMod\Providers;
use Illuminate\Support\ServiceProvider;

class LocationModServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {

    }
}

