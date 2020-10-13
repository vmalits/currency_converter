<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BnmExchangeRatesService
{
    private string $url = 'https://www.bnm.md/ro/official_exchange_rates';

    /**
     * Example: 02.02.2020
     * @param string $date
     * @return string
     */
    public function getRates(string $date): string
    {
        return Http::get($this->url, ['get_xml' => 1, 'date' => $date])->body();
    }
}
