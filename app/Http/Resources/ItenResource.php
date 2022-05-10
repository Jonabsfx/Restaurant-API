<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItenResource extends JsonResource
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
            'name' => ucwords(strtolower($this->name)),
            'value' => $this->value,
            'menu' => MenuResource::collection($this->whenLoaded('menu')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
