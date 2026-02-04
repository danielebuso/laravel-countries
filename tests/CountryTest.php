<?php

use Danielebuso\LaravelCountries\Models\Country;

describe('Country Model', function () {
    it('can retrieve all countries', function () {
        $countries = Country::all();
        
        expect($countries)->toBeIterable()
            ->and($countries->count())->toBeGreaterThan(0)
            ->and($countries->count())->toBe(249);
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
        
        expect($countries)->toHaveCount(4); // United States, United Kingdom, United Arab Emirates, United States Minor Outlying Islands
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
            ->and($page->total())->toBe(249);
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

    it('includes territories and dependencies', function () {
        $territories = [
            ['alpha2' => 'PR', 'name' => 'Puerto Rico', 'alpha3' => 'PRI'],
            ['alpha2' => 'GU', 'name' => 'Guam', 'alpha3' => 'GUM'],
            ['alpha2' => 'HK', 'name' => 'Hong Kong', 'alpha3' => 'HKG'],
            ['alpha2' => 'MO', 'name' => 'Macau', 'alpha3' => 'MAC'],
            ['alpha2' => 'GL', 'name' => 'Greenland', 'alpha3' => 'GRL'],
            ['alpha2' => 'BM', 'name' => 'Bermuda', 'alpha3' => 'BMU'],
            ['alpha2' => 'GF', 'name' => 'French Guiana', 'alpha3' => 'GUF'],
            ['alpha2' => 'AX', 'name' => 'Åland Islands', 'alpha3' => 'ALA'],
        ];

        foreach ($territories as $territory) {
            $country = Country::where('alpha2', $territory['alpha2'])->first();
            expect($country)->not->toBeNull()
                ->and($country->name)->toBe($territory['name'])
                ->and($country->alpha3)->toBe($territory['alpha3']);
        }
    });
});
