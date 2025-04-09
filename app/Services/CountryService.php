<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CountryService
{
    private $baseUrl = "https://restcountries.com/v3.1";

    public function getAllCountries()
    {
        return Cache::remember('all_countries', 600, function () {
            $response = Http::withOptions([
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                ])
                ->get("{$this->baseUrl}/all");
            return $response->successful() ? $response->json() : [];
        });
    }

    public function getCountryByName($name)
    {
        return Cache::remember("country_{$name}", 600, function () use ($name) {
            $response = Http::get("{$this->baseUrl}/name/{$name}");
            return $response->successful() ? $response->json() : null;
        });
    }
}
