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
            'id' => $this->id,
            'status' => $this->status,
            'waiter' => WaiterResource::collection($this->whenLoaded('waiter')),
            'customer' => CustomerResource::collection($this->whenLoaded('customer')),
            'table' => TableResource::collection($this->whenLoaded('table')),
            'itens' => ItenResource::collection($this->whenLoaded('itens')),
        ];
    }
}
