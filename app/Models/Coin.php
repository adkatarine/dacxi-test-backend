<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'coin_id', 'name', 'symbol'];
    public $incrementing = false;

    public function historic_prices() {
        return $this->hasMany(HistoricPrice::class);
    }
}
