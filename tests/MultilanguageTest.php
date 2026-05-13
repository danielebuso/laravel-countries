<?php

use Danielebuso\LaravelCountries\Models\Country;

describe('Multilanguage Support', function () {
    it('returns country name in spanish', function () {
        $countries = [
            ['alpha2' => 'IT', 'es' => 'Italia'],
            ['alpha2' => 'DE', 'es' => 'Alemania'],
            ['alpha2' => 'FR', 'es' => 'Francia'],
            ['alpha2' => 'ES', 'es' => 'España'],
        ];

        foreach ($countries as $data) {
            $country = Country::where('alpha2', $data['alpha2'])->first();
            $translatedName = $country->getName('es');
            expect($translatedName)->toBe($data['es']);
        }
    });

    it('returns country name in french', function () {
        $countries = [
            ['alpha2' => 'IT', 'fr' => 'Italie'],
            ['alpha2' => 'DE', 'fr' => 'Allemagne'],
            ['alpha2' => 'GB', 'fr' => 'Royaume-Uni'],
            ['alpha2' => 'US', 'fr' => 'États-Unis'],
        ];

        foreach ($countries as $data) {
            $country = Country::where('alpha2', $data['alpha2'])->first();
            $translatedName = $country->getName('fr');
            expect($translatedName)->toBe($data['fr']);
        }
    });

    it('returns country name in italian', function () {
        $countries = [
            ['alpha2' => 'IT', 'it' => 'Italia'],
            ['alpha2' => 'DE', 'it' => 'Germania'],
            ['alpha2' => 'FR', 'it' => 'Francia'],
            ['alpha2' => 'ES', 'it' => 'Spagna'],
        ];

        foreach ($countries as $data) {
            $country = Country::where('alpha2', $data['alpha2'])->first();
            $translatedName = $country->getName('it');
            expect($translatedName)->toBe($data['it']);
        }
    });

    it('returns translations containing apostrophes correctly', function () {
        $countries = [
            ['alpha2' => 'CI', 'locale' => 'fr', 'name' => 'Côte d\'Ivoire'],
            ['alpha2' => 'IO', 'locale' => 'fr', 'name' => 'Territoire britannique de l\'océan Indien'],
            ['alpha2' => 'CI', 'locale' => 'it', 'name' => 'Costa d\'Avorio'],
            ['alpha2' => 'IO', 'locale' => 'it', 'name' => 'Territorio britannico dell\'oceano indiano'],
            ['alpha2' => 'SH', 'locale' => 'it', 'name' => 'Sant\'Elena, Ascensione e Tristan da Cunha'],
        ];

        foreach ($countries as $data) {
            $country = Country::where('alpha2', $data['alpha2'])->first();
            $translatedName = $country->getName($data['locale']);
            expect($translatedName)->toBe($data['name']);
        }
    });

    it('returns country name in croatian', function () {
        $countries = [
            ['alpha2' => 'HR', 'hr' => 'Hrvatska'],
            ['alpha2' => 'DE', 'hr' => 'Njemačka'],
            ['alpha2' => 'IT', 'hr' => 'Italija'],
            ['alpha2' => 'US', 'hr' => 'Sjedinjene Američke Države'],
            ['alpha2' => 'AX', 'hr' => 'Åland Islands'],
        ];

        foreach ($countries as $data) {
            $country = Country::where('alpha2', $data['alpha2'])->first();
            $translatedName = $country->getName('hr');
            expect($translatedName)->toBe($data['hr']);
        }
    });

    it('falls back to english name when translation is not available', function () {
        $usa = Country::where('alpha2', 'US')->first();

        // Request translation for a non-existent language
        $name = $usa->getName('xx');

        expect($name)->toBe('United States'); // Should return English name
    });

    it('uses app locale when no locale specified', function () {
        $italy = Country::where('alpha2', 'IT')->first();

        // Set app locale to Spanish
        app()->setLocale('es');

        $name = $italy->getName();

        expect($name)->toBe('Italia'); // Should return Spanish name
    });

    it('returns translated names for territories and dependencies', function () {
        $territories = [
            ['alpha2' => 'PR', 'es' => 'Puerto Rico', 'fr' => 'Porto Rico', 'it' => 'Porto Rico', 'de' => 'Puerto Rico'],
            ['alpha2' => 'HK', 'es' => 'Hong Kong', 'fr' => 'Hong Kong', 'it' => 'Hong Kong', 'de' => 'Hongkong'],
            ['alpha2' => 'GL', 'es' => 'Groenlandia', 'fr' => 'Groenland', 'it' => 'Groenlandia', 'de' => 'Grönland'],
            ['alpha2' => 'GU', 'es' => 'Guam', 'fr' => 'Guam', 'it' => 'Guam', 'de' => 'Guam'],
        ];

        foreach ($territories as $territory) {
            $country = Country::where('alpha2', $territory['alpha2'])->first();
            expect($country)->not->toBeNull();
            expect($country->getName('es'))->toBe($territory['es']);
            expect($country->getName('fr'))->toBe($territory['fr']);
            expect($country->getName('it'))->toBe($territory['it']);
            expect($country->getName('de'))->toBe($territory['de']);
        }
    });
});
