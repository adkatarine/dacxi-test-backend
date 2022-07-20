<?php

namespace App\Http\Controllers;

use App\Models\HistoricPrice;
use App\Http\Resources\HistoricPriceCollection;
use App\Http\Resources\HistoricPriceResource;
use Illuminate\Http\Request;

class HistoricPriceController extends Controller
{

    public function __construct(HistoricPrice $historicPrice) {
        $this->historicPrice = $historicPrice;
    }

    /**
     * Display the latest Bitcoin price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lastPriceBitcoin(Request $request) {
        $historicPrice = new HistoricPriceResource($this->historicPrice
            ->where('coin_id', $request->coin_id)->orderBy('created_at', 'desc')->first());
        return response()->json($historicPrice, 200);
    }

    /**
     * Display the estimated price of Bitcoin at a given date and time.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function priceDatetimeBitcoin(Request $request) {
        $historicPrice = $this->historicPrice
            ->where('coin_id', $request->coin_id)
            ->whereDate('created_at', $request->date)
            ->whereTime('created_at', $request->time)->get();
        return response()->json($historicPrice, 200);

        #TODO: flexibilizar busca de hora
    }

    /**
     * Store the price of a coin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $historicPrice = $this->historicPrice->create($request->all());
        return response()->json($historicPrice, 201);
    }

    /**
     * Display the price historic for a specified coin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $historicPrice = new HistoricPriceCollection($this->historicPrice->where('coin_id', $request->coin_id)->get());
        if (!$historicPrice) {
            return response()->json(['error'=>'Historico de preços de '.$request->coin_id.' não existe.'], 404);
        }
        return response()->json($historicPrice, 200);
    }

    /**
     * Remove price historic for a specified coin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $historicPrice = $this->historicPrice->where('coin_id', $request->coin_id)->get();
        if (!$historicPrice) {
            return response()->json(['error'=>'Historico de preços de '.$request->coin_id.' não existe.'], 404);
        }
        $historicPrice->delete();
        return response()->json($historicPrice, 200);
    }
}
