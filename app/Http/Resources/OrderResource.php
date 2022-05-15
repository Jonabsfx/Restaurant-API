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
            'waiter' =>  new WaiterResource($this->waiter),
            'customer' => new CustomerResource($this->customer),
            'table' => new TableResource($this->table),
            'itens' => ItenResource::collection($this->itens),
            'total' => $this->total
        ];
    }
}
