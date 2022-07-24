<?php

namespace App\Console\Commands;

use App\Utils\FormatData;
use App\Models\Coin;
use App\Models\HistoricPrice;
use App\Http\Controllers\HistoricPriceController;
use App\Repositories\API\CoinGeckoApi as APICrypto;
use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Command;

class SaveCryptoPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:CurrentCryptoPrice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Solicita e salva o preço atual de cryptos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $coinHistoricController = new HistoricPriceController(new HistoricPrice());
        $request = new \Illuminate\Http\Request();
        list($coins, $coins_id) = Cache::remember('list_coins', 43200, function () {
            return FormatData::implodeCoinsId(Coin::select('id','coin_id')->get());
        });

        $priceCoins = FormatData::jsonDecodeResponse(APICrypto::getPriceCoins($coins));

        foreach ($priceCoins as $key => $crypto) {
            $coinHistoricController->store($request->replace([
                "coin_id" => $coins_id[$key],
                "price" => $crypto[APICrypto::$coinPrice]
            ]));
        }
    }
}
