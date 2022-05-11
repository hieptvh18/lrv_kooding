<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // use api resource de tra ve cac field mong muon(bao mat or tran data)
        return [
            'order_id'=>$this->order_id,
            'product_id'=>$this->product_id,
            'size_id'=>$this->size_id,
            'color_id'=>$this->color_id,
            'quantity'=>$this->quantity,
        ];
    }
}
