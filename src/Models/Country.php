<?php

namespace Danielebuso\LaravelCountries\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Country extends Model
{
    use Sushi;

    protected $schema = [
        'id' => 'string',
        'alpha2' => 'string',
        'alpha3' => 'string',
        'name' => 'string',
    ];

    /**
     * Cache for loaded translations
     *
     * @var array
     */
    protected static $translationsCache = [];

    /**
     * Get the country name in the specified language.
     *
     * @param  string|null  $locale
     * @return string
     */
    public function getName(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        
        $translations = $this->getTranslations($locale);
        
        return $translations[$this->alpha2] ?? $this->name;
    }

    /**
     * Get all translations for countries.
     *
     * @param  string  $locale
     * @return array
     */
    protected function getTranslations(string $locale): array
    {
        // Return cached translations if available
        if (isset(static::$translationsCache[$locale])) {
            return static::$translationsCache[$locale];
        }

        $translationsPath = __DIR__.'/../../resources/data/translations';
        $translationFile = $translationsPath.'/'.$locale.'.php';

        if (file_exists($translationFile)) {
            static::$translationsCache[$locale] = require $translationFile;
            return static::$translationsCache[$locale];
        }

        // Cache empty array for non-existent locales to avoid repeated file checks
        static::$translationsCache[$locale] = [];
        return [];
    }

    /**
     * Get the data for Sushi.
     *
     * @return array
     */
    public function getRows(): array
    {
        $dataFile = __DIR__.'/../../resources/data/countries.php';

        if (file_exists($dataFile)) {
            return require $dataFile;
        }

        return [];
    }
}
