<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class CountryService
{
    private $baseUrl = "https://restcountries.com/v3.1";

    public function api($cacheName, $urlPath)
    {
        return Cache::remember($cacheName, 600, function () use ($urlPath) {
            try {
                $response = Http::withOptions([
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                ])
                    ->retry(5, 100, throw: false)
                    ->get("{$this->baseUrl}/{$urlPath}");
                return $response->successful() ? $response->json() : null;
            } catch (Exception $ex) {
                return null;
            }
        });
    }

    public function getCountries($name, $region, $sortBy, $order)
    {
        try {
            if (!empty($name)) {
                $countries = (array) $this->api("country_{$name}", "name/{$name}");
            } else {
                $countries = (array) $this->api("all_countries_filter", "all");
            }

            if (!empty($region)) {
                $countries = array_filter($countries, function ($country) use ($region) {
                    return isset($country['region']) && strtolower($country['region']) === strtolower($region);
                });
            }

            // Sorting logic
            usort($countries, function ($a, $b) use ($sortBy, $order) {
                $valueA = $a[$sortBy] ?? '';
                $valueB = $b[$sortBy] ?? '';

                if ($sortBy === 'population') {
                    $valueA = intval($valueA);
                    $valueB = intval($valueB);
                } else {
                    $valueA = strtolower($valueA['common']);
                    $valueB = strtolower($valueB['common']);
                }

                return $order === 'asc' ? $valueA <=> $valueB : $valueB <=> $valueA;
            });
            return !empty($countries) ? array_values($countries) : null;
        } catch (Exception $ex) {
            return null;
        }
    }

    public function getCountryByName($name)
    {
        return (array) $this->api("country_{$name}", "name/{$name}");
    }
}
