<?php

namespace App\Console\Commands;

use App\Helpers\XmlToArrayConvert;
use App\Models\BnmExchangeRate;
use App\Services\BnmExchangeRatesService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetBnmExchangeRates extends Command
{
    use XmlToArrayConvert;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bnm:get-exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting BNM exchange rates from api';
    /**
     * @var BnmExchangeRatesService
     */
    private BnmExchangeRatesService $bnmExchangeRatesService;

    /**
     * Create a new command instance.
     *
     * @param BnmExchangeRatesService $bnmExchangeRatesService
     */
    public function __construct(BnmExchangeRatesService $bnmExchangeRatesService)
    {
        parent::__construct();
        $this->bnmExchangeRatesService = $bnmExchangeRatesService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayAlreadyReceived = BnmExchangeRate::whereDate('created_at', today())->first();
        if ($todayAlreadyReceived) {
            $this->info('The rates already received!');
            return 1;
        }

        $today = today()->format('d.m.Y');
        $xml = $this->bnmExchangeRatesService->getRates($today);
        $rates = $this->xmlToArray($xml);
        $prepareRatesForSave = [];
        foreach ($rates['Valute'] as $rate) {
            $prepareRatesForSave[strtolower($rate['CharCode'])] = $rate['Value'];
        }

        BnmExchangeRate::create($prepareRatesForSave);
        $this->info('The rates received successfully!');
        return 0;
    }
}
