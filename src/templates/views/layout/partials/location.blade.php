@php
    use Statamic\Facades\Form;

    $entries = \Statamic\Facades\Collection::find('locations')->queryEntries()->where('published', true)->get();

    $locations = $entries->map(function ($entry) {
        return $entry
            ->toAugmentedCollection(['id', 'title', 'location_address', 'location_address_url', 'location_open_hours', 'location_coming', 'location_menu_link'])
            ->withShallowNesting()
            ->toArray();
    });

@endphp

@extends('layout')

@section('body')

@endsection
