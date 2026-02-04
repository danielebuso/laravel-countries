<?php

// config for Danielebuso/LaravelCountries
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
