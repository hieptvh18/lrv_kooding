<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "phone" => $this->phone,
            "name" => $this->name,
            "total_price" => $this->total_price,
            "address" => $this->address,
            "created_at" => $this->created_at->format('d/m/y'),
            "code_voucher" => $this->code_voucher,
            "note" => $this->note
        ];
    }
}
