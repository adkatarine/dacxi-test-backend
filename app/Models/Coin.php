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

    public function rules() {
        return [
            'coin_id' => 'required|unique:coins,coin_id,'.$this->id.'|max:15',
            'name' => 'required|unique:coins,name,'.$this->id.'|max:20',
            'symbol' => 'required|unique:coins,symbol,'.$this->id.'|max:30',
        ];
    }

    public function rule_id() {
        return [
            'id' => 'required|unique:coins,id,'.$this->id.'|max:15',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute já existe',
            'max' => 'O campo :attribute passou da quantidade (15) máxima de caracteres permitido.',
        ];
    }
}
