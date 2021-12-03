<?php

namespace App\Http\Controllers;

use App\Http\Services\CountryService;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct(
        private CountryService $countryService
    ) {}

    public function index()
    {
        return view('country.index', [
            'countries' => Country::indexList(),
            'statistic' => $this->countryService->statistics(request()->capital, request()->country, request()->date)
        ]);
    }
}
