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

    public function rules() {
        return [
            'coin_id' => 'required|max:15',
            'price' => 'required',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute passou da quantidade (15) máxima de caracteres permitido.',
        ];
    }
}
