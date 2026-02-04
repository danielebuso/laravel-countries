<?php

use Danielebuso\LaravelCountries\Models\Country;

it('can retrieve all countries', function () {
    $countries = Country::all();
    
    expect($countries)->toBeIterable()
        ->and($countries->count())->toBeGreaterThan(0);
});

it('can find a country by alpha2 code', function () {
    $usa = Country::where('alpha2', 'US')->first();
    
    expect($usa)->not->toBeNull()
        ->and($usa->name)->toBe('United States')
        ->and($usa->alpha3)->toBe('USA');
});

it('can find a country by alpha3 code', function () {
    $france = Country::where('alpha3', 'FRA')->first();
    
    expect($france)->not->toBeNull()
        ->and($france->alpha2)->toBe('FR')
        ->and($france->name)->toBe('France');
});

it('returns correct country name for default locale', function () {
    $italy = Country::where('alpha2', 'IT')->first();
    
    expect($italy)->not->toBeNull()
        ->and($italy->name)->toBe('Italy');
});
