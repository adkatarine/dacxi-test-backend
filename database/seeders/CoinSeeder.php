<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coin::create([
            'id' => 'bitcoin',
            'coin_id' => 'bitcoin',
            'name' => 'Bitcoin',
            'symbol' => 'btc'
        ]);
        Coin::create([
            'id' => 'dacxi',
            'coin_id' => 'dacxi',
            'name' => 'Dacxi',
            'symbol' => 'dacxi'
        ]);
        Coin::create([
            'id' => 'ethereum',
            'coin_id' => 'ethereum',
            'name' => 'Ethereum',
            'symbol' => 'eth'
        ]);
        Coin::create([
            'id' => 'cosmos',
            'coin_id' => 'cosmos',
            'name' => 'Cosmos Hub',
            'symbol' => 'atom'
        ]);
        Coin::create([
            'id' => 'terra-luna',
            'coin_id' => 'terra-luna',
            'name' => 'Terra Luna Classic',
            'symbol' => 'lunc'
        ]);
    }
}
