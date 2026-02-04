# Laravel Countries

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danielebuso/laravel-countries.svg?style=flat-square)](https://packagist.org/packages/danielebuso/laravel-countries)
[![Total Downloads](https://img.shields.io/packagist/dt/danielebuso/laravel-countries.svg?style=flat-square)](https://packagist.org/packages/danielebuso/laravel-countries)

A Laravel package that provides an easy way to query and browse country data with **multilanguage support** using Sushi. Unlike other country packages, this one includes country names in multiple languages, making it perfect for international applications.

This package uses data structure inspired by [stefangabos/world_countries](https://github.com/stefangabos/world_countries) and leverages [Sushi](https://github.com/calebporzio/sushi) to provide a seamless Eloquent-like interface for static country data.

## Features

- 🌍 Complete ISO 3166-1 list with 249 entities including countries, territories, and dependencies
- 🌐 **Multilanguage support** - Country names in multiple languages (English, Spanish, French, Italian, and more)
- 🔍 Query countries using Laravel's Eloquent ORM
- ⚡ Fast performance with Sushi's in-memory caching
- 🎯 Simple and intuitive API
- 📦 Zero database migrations required

## Installation

You can install the package via composer:

```bash
composer require danielebuso/laravel-countries
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-countries-config"
```

This is the contents of the published config file:

```php
return [
    /*
     * The default locale to use when retrieving country names.
     * If not set, it will use Laravel's app locale.
     */
    'locale' => null,

    /*
     * Cache configuration for country data.
     * Sushi automatically caches the data, but you can configure it here.
     */
    'cache' => [
        'enabled' => true,
        'ttl' => 3600, // Time in seconds
    ],
];
```

## Usage

### What's Included

This package includes the complete ISO 3166-1 standard with **249 entities**:

- **Sovereign states**: All 193 UN member states plus Vatican City, Palestine, Kosovo, Taiwan
- **Territories**: Puerto Rico, Guam, U.S. Virgin Islands, American Samoa, etc.
- **Dependencies**: Greenland, Bermuda, French Polynesia, Faroe Islands, etc.
- **Special Administrative Regions**: Hong Kong, Macau
- **Other entities**: Antarctica, Åland Islands, and more

This comprehensive list ensures you have access to all officially recognized ISO codes, not just UN member states.

### Basic Usage

```php
use Danielebuso\LaravelCountries\Models\Country;

// Get all countries
$countries = Country::all();

// Find a country by alpha-2 code
$usa = Country::where('alpha2', 'US')->first();

// Find a country by alpha-3 code
$italy = Country::where('alpha3', 'ITA')->first();

// Get countries sorted by name
$countries = Country::orderBy('name')->get();
```

### Multilanguage Support

The package includes built-in support for multiple languages. Country names are available in:

- English (en) - Default
- Spanish (es)
- French (fr)
- Italian (it)
- German (de)

```php
use Danielebuso\LaravelCountries\Models\Country;

// Get country name in a specific language
$italy = Country::where('alpha2', 'IT')->first();

// Get name in Italian
$italianName = $italy->getName('it'); // Returns "Italia"

// Get name in Spanish
$spanishName = $italy->getName('es'); // Returns "Italia"

// Get name in French
$frenchName = $italy->getName('fr'); // Returns "Italie"

// Get name using app's current locale
app()->setLocale('es');
$localizedName = $italy->getName(); // Returns "Italia" (Spanish)
```

### Query Examples

```php
// Search countries by name
$countries = Country::where('name', 'LIKE', '%United%')->get();

// Get a specific country
$germany = Country::where('alpha2', 'DE')->first();
echo $germany->name; // Germany
echo $germany->alpha3; // DEU
echo $germany->id; // 276

// Count all countries
$total = Country::count();

// Pagination
$countries = Country::paginate(20);
```

### Available Fields

Each country model has the following attributes:

- `id` - ISO 3166-1 numeric code
- `alpha2` - ISO 3166-1 alpha-2 code (e.g., 'US', 'IT', 'FR')
- `alpha3` - ISO 3166-1 alpha-3 code (e.g., 'USA', 'ITA', 'FRA')
- `name` - Country name in English

## Why This Package?

While there are several Laravel packages that provide country data, this package stands out because:

1. **Multilanguage Support**: Unlike most packages, this one includes country names in multiple languages out of the box
2. **No Database Required**: Uses Sushi to work with static data without migrations
3. **Familiar API**: Works just like any Eloquent model
4. **Actively Maintained**: Built on modern Laravel standards
5. **Lightweight**: Minimal dependencies and fast performance

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Daniele Buso](https://github.com/danielebuso)
- [All Contributors](../../contributors)
- Data structure inspired by [stefangabos/world_countries](https://github.com/stefangabos/world_countries)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
