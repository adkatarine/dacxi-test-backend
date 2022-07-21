<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricPrice extends Model
{
    use HasFactory;

    protected $fillable = ['coin_id', 'price'];

    public function coin() {
        return $this->belongsTo(Coin::class);
    }
}
