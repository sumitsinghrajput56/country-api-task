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
        $countries = $this->countryService->getAllCountries();
        return view('countries.index', compact('countries'));
    }

    public function show($name)
    {
        $country = $this->countryService->getCountryByName($name);
        if (!$country) return abort(404, 'Country Not Found');
        return view('countries.details', ['country' => $country[0]]);
    }

    public function search(Request $request)
    {
        $name = $request->query('name');
        $countries = $this->countryService->getCountryByName($name);
        return view('countries.index', compact('countries'));
    }
}
