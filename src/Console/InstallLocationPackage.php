<?php

namespace Astricelng\LocationMod\Console;

use Illuminate\Console\Command;
use Statamic\Facades\AssetContainer;
use Statamic\Facades\Collection;
use Statamic\Facades\Entry;

class InstallLocationPackage extends Command
{
    protected $signature = 'locationpackage:install';

    protected $description = 'Install the LocationModPackage';

    public function handle()
    {
        $this->info('Installing LocationModPackage...');

        $this->info('Copying location collection blueprint...');
        $this->copyLocationCollectionBlueprint();

        $this->info('Creating location collection...');
        $this->createLocationCollection();

        $this->info('Copying location partial page...');
        $this->copyLocationPage();

        $this->info('Installed LocationModPackage');

    }

    private function copyLocationCollectionBlueprint(){

        $locationCollection = app('files')->get(__DIR__ . '/../templates/blueprints/collections/location.yaml');

        // If collections/locations directory doesn't exist, create it
        if (!file_exists(base_path('resources/blueprints/collections/locations/')))
            mkdir(base_path('resources/blueprints/collections/locations/'), 0770, true);

        app('files')->put(base_path('resources/blueprints/collections/locations/location.yaml'), $locationCollection);
    }

    private function createLocationCollection(){

        $collection = Collection::make('locations');
        $collection
            ->title('Locations')
            ->dated(true)
            ->template('default')
            ->layout('layout')
            ->revisionsEnabled(false)
            ->sortDirection('asc')
            ->save();
    }

    private function copyLocationPage(){

        $locationPage = app('files')->get(__DIR__ . '/../templates/views/layout/packages/_location.blade.php');

        if (!file_exists(base_path('resources/views/layout/')))
            mkdir(base_path('resources/views/layout/'), 0770, true);

        if (!file_exists(base_path('resources/views/layout/packages/')))
            mkdir(base_path('resources/views/layout/packages/'), 0770, true);

        app('files')->put(base_path('resources/views/layout/packages/_location.blade.php'), $locationPage);

    }

}
