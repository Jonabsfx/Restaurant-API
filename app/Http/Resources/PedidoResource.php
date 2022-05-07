<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
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
            'data' => $this->data,
            'funcionario' => FuncionarioResource::collection($this->whenLoaded('funcionario')),
            'cliente' => ClienteResource::collection($this->whenLoaded('cliente')),
            'mesa' => MesaResource::collection($this->whenLoaded('mesa')),
            'itens' => ItemResource::collection($this->whenLoaded('itens')),
        ];
    }
}