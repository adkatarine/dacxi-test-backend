<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function __construct(Coin $coin) {
        $this->coin = $coin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = $this->coin->get();
        return response()->json($coins, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->coin->rule_id(), $this->coin->feedback());
        $request->validate($this->coin->rules(), $this->coin->feedback());

        $coin = $this->coin->create($request->all());
        return response()->json($coin, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $coin
     * @return \Illuminate\Http\Response
     */
    public function show($coin_id)
    {
        $coin = $this->coin->find($coin_id);
        if (!$coin) {
            return response()->json(['error'=>'Moeda '.$coin_id.' não existe.'], 404);
        }
        return response()->json($coin, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $coin_id)
    {
        $coin = $this->coin->find($coin_id);
        if (!$coin) {
            return response()->json(['error'=>'Moeda '.$coin_id.' não existe.'], 404);
        }

        $request->validate($this->coin->rules(), $this->coin->feedback());

        $coin->fill($request->all());
        $coin->save();
        return response()->json($coin, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy($coin_id)
    {
        $coin = $this->tag->find($coin_id);
        if (!$coin) {
            return response()->json(['error'=>'Moeda '.$coin_id.' não existe.'], 404);
        }
        $coin->delete();
        return response()->json($coin, 200);
    }
}
