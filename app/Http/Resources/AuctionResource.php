<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date_end' => $this->date_end,
            'start_price' => $this->start_price/100,
            'image' => 'https://via.placeholder.com/800x600.png/00aaee?text=auctions',
            'meters' => $this->meters,
            'rooms_quantity' => $this->rooms_quantity,
            'category' => new CategoryResource($this->category)
        ];
    }
}
