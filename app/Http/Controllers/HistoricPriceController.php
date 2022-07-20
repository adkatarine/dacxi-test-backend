<?php

namespace App\Http\Controllers;

use App\Models\HistoricPrice;
use Illuminate\Http\Request;

class HistoricPriceController extends Controller
{

    public function __construct(HistoricPrice $historicPrice) {
        $this->historicPrice = $historicPrice;
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  string  $coin_id
     * @return \Illuminate\Http\Response
     */
    public function show($coin_id)
    {
        $historicPrice = $this->historicPrice->where('coin_id', $coin_id)->get();
        if (!$historicPrice) {
            return response()->json(['error'=>'Historico de preços de '.$coin_id.' não existe.'], 404);
        }
        return response()->json($historicPrice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $coin_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($coin_id)
    {
        $historicPrice = $this->historicPrice->where('coin_id', $coin_id)->get();
        if (!$historicPrice) {
            return response()->json(['error'=>'Historico de preços de '.$coin_id.' não existe.'], 404);
        }
        $historicPrice->delete();
        return response()->json($historicPrice, 200);
    }
}
