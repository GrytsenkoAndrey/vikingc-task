<?php

namespace App\Http\Services;

use App\Models\Country;
use Illuminate\Support\Collection;

class CountryService
{
    /**
     * @param string|null $capital
     * @param string|null $country
     * @param string|null $date
     * @return Collection
     */
    public function statistics(?string $capital, ?string $country, ?string $date): Collection
    {
        if (!$capital && !$country && !$date) {
            return collect([]);
        }

        return Country::filter('capital', $capital ?? '')
            ->filter('title', $country ?? '')
            ->filter('created_at', $date ?? '')
            ->with('statistic')
            ->get();
    }
}
