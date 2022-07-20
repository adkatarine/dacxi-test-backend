<?php

namespace App\Repositories\API;

use Illuminate\Support\Facades\Http;

class CoinGeckoApi implements APICryptoInterface {

    static $url = 'https://api.coingecko.com/api/v3/simple';
    static $coinPrice = 'brl';

    /**
     * Display the specified resource.
     *
     * @param  string  $idCoins
     * @return \Illuminate\Http\Response
     */
    public static function getPriceCoins(string $idCoins) {
        return Http::get(self::$url.'/price?ids='.$idCoins.'&vs_currencies='.self::$coinPrice);
    }
}
