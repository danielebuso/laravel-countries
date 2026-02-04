<?php

/**
 * Example usage of Laravel Countries package
 * 
 * This file demonstrates various ways to use the package
 */

require __DIR__ . '/../vendor/autoload.php';

use Danielebuso\LaravelCountries\Models\Country;

// Note: In a real Laravel application, you don't need to set up the database
// This is just for demonstration purposes outside of Laravel

echo "Laravel Countries Package - Usage Examples\n";
echo "==========================================\n\n";

// Example 1: Get all countries
echo "1. Get all countries:\n";
$allCountries = Country::all();
echo "   Total: {$allCountries->count()} countries\n\n";

// Example 2: Find a specific country by alpha-2 code
echo "2. Find country by alpha-2 code:\n";
$usa = Country::where('alpha2', 'US')->first();
echo "   {$usa->name} ({$usa->alpha2}, {$usa->alpha3})\n\n";

// Example 3: Find a country by alpha-3 code
echo "3. Find country by alpha-3 code:\n";
$italy = Country::where('alpha3', 'ITA')->first();
echo "   {$italy->name} ({$italy->alpha2}, {$italy->alpha3})\n\n";

// Example 4: Search countries by name
echo "4. Search countries with 'United' in name:\n";
$unitedCountries = Country::where('name', 'LIKE', '%United%')->get();
foreach ($unitedCountries as $country) {
    echo "   - {$country->name}\n";
}
echo "\n";

// Example 5: Get countries in alphabetical order
echo "5. First 5 countries alphabetically:\n";
$alphabetical = Country::orderBy('name')->take(5)->get();
foreach ($alphabetical as $country) {
    echo "   - {$country->name}\n";
}
echo "\n";

// Example 6: Pagination
echo "6. Paginated results (page 1, 10 per page):\n";
$page = Country::paginate(10);
echo "   Showing {$page->count()} of {$page->total()} countries\n";
foreach ($page as $country) {
    echo "   - {$country->name}\n";
}
echo "\n";

// Example 7: Multilanguage support
echo "7. Country names in different languages:\n";
$france = Country::where('alpha2', 'FR')->first();
echo "   English: {$france->name}\n";
echo "   Spanish: {$france->getName('es')}\n";
echo "   French: {$france->getName('fr')}\n";
echo "   Italian: {$france->getName('it')}\n";
echo "   German: {$france->getName('de')}\n\n";

// Example 8: Multiple countries with translations
echo "8. European countries with German names:\n";
$europeanCountries = ['DE', 'FR', 'IT', 'ES', 'NL'];
foreach ($europeanCountries as $code) {
    $country = Country::where('alpha2', $code)->first();
    if ($country) {
        echo "   {$country->name} => {$country->getName('de')}\n";
    }
}
echo "\n";

// Example 9: Count countries by query
echo "9. Statistical queries:\n";
$totalCountries = Country::count();
$countriesWithA = Country::where('name', 'LIKE', 'A%')->count();
echo "   Total countries: {$totalCountries}\n";
echo "   Countries starting with 'A': {$countriesWithA}\n\n";

// Example 10: Get specific countries by array of codes
echo "10. Get specific countries (BRICS nations):\n";
$bricsCodes = ['BR', 'RU', 'IN', 'CN', 'ZA'];
$bricsCountries = Country::whereIn('alpha2', $bricsCodes)->get();
foreach ($bricsCountries as $country) {
    echo "   - {$country->name} ({$country->alpha2})\n";
}

echo "\n✅ Examples completed successfully!\n";
