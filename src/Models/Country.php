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
     * Get the country name in the specified language.
     *
     * @param  string|null  $locale
     * @return string
     */
    public function getName(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        
        $translations = $this->getTranslations();
        
        return $translations[$this->alpha2][$locale] ?? $this->name;
    }

    /**
     * Get all translations for countries.
     *
     * @return array
     */
    protected function getTranslations(): array
    {
        $translationsPath = __DIR__.'/../../resources/data/translations';
        $locale = app()->getLocale();
        $translationFile = $translationsPath.'/'.$locale.'.php';

        if (file_exists($translationFile)) {
            return require $translationFile;
        }

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
