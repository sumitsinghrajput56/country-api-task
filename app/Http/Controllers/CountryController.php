<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        return view('countries.index');
    }

    public function getCountries(Request $request)
    {
        $name = $request->query('name');
        $region = $request->query('region');
        $sortBy = $request->query('sortBy', 'name');
        $order = $request->query('order', 'asc');

        $countries = (array) $this->countryService->getCountries($name, $region, $sortBy, $order);

        return response()->json($countries);
    }

    public function show($name)
    {
        $country = $this->countryService->getCountryByName($name);
        if (!$country) return abort(404, 'Country Not Found');
        return view('countries.details', ['country' => $country[0]]);
    }
}
