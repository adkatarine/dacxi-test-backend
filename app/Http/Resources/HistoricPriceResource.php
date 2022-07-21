<?php

namespace App\Http\Resources;

use App\Utils\FormatData;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoricPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $datetime = FormatData::dateTime($this->created_at);
        return [
            'id' => $this->id,
            'coin_id' => $this->coin_id,
            'name' => new CoinResource($this->coin),
            'price' => $this->price,
            'date' => $datetime['date'],
            'time' => $datetime['time'],
        ];
    }
}
