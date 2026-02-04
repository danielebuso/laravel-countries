<?php

use Danielebuso\LaravelCountries\Models\Country;

describe('Country Model', function () {
    it('can retrieve all countries', function () {
        $countries = Country::all();
        
        expect($countries)->toBeIterable()
            ->and($countries->count())->toBeGreaterThan(0)
            ->and($countries->count())->toBe(195);
    });

    it('has required fields', function () {
        $country = Country::first();
        
        expect($country)->toHaveKeys(['id', 'alpha2', 'alpha3', 'name']);
    });

    it('can find a country by alpha2 code', function () {
        $usa = Country::where('alpha2', 'US')->first();
        
        expect($usa)->not->toBeNull()
            ->and($usa->name)->toBe('United States')
            ->and($usa->alpha3)->toBe('USA')
            ->and($usa->id)->toBe('840');
    });

    it('can find a country by alpha3 code', function () {
        $france = Country::where('alpha3', 'FRA')->first();
        
        expect($france)->not->toBeNull()
            ->and($france->alpha2)->toBe('FR')
            ->and($france->name)->toBe('France');
    });

    it('can find a country by name', function () {
        $germany = Country::where('name', 'Germany')->first();
        
        expect($germany)->not->toBeNull()
            ->and($germany->alpha2)->toBe('DE')
            ->and($germany->alpha3)->toBe('DEU');
    });

    it('can search countries by name pattern', function () {
        $countries = Country::where('name', 'LIKE', '%United%')->get();
        
        expect($countries)->toHaveCount(3); // United States, United Kingdom, United Arab Emirates
    });

    it('can order countries by name', function () {
        $countries = Country::orderBy('name')->get();
        
        expect($countries->first()->name)->toBe('Afghanistan')
            ->and($countries->last()->name)->toBe('Zimbabwe');
    });

    it('can paginate countries', function () {
        $page = Country::paginate(20);
        
        expect($page)->toBeInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class)
            ->and($page->count())->toBe(20)
            ->and($page->total())->toBe(195);
    });

    it('returns correct country for specific codes', function () {
        $testCases = [
            ['alpha2' => 'IT', 'name' => 'Italy', 'alpha3' => 'ITA'],
            ['alpha2' => 'JP', 'name' => 'Japan', 'alpha3' => 'JPN'],
            ['alpha2' => 'BR', 'name' => 'Brazil', 'alpha3' => 'BRA'],
            ['alpha2' => 'CA', 'name' => 'Canada', 'alpha3' => 'CAN'],
            ['alpha2' => 'AU', 'name' => 'Australia', 'alpha3' => 'AUS'],
        ];

        foreach ($testCases as $testCase) {
            $country = Country::where('alpha2', $testCase['alpha2'])->first();
            expect($country)->not->toBeNull()
                ->and($country->name)->toBe($testCase['name'])
                ->and($country->alpha3)->toBe($testCase['alpha3']);
        }
    });
});
