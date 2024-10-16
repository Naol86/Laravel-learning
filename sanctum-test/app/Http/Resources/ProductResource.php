<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // return $this->all();
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'detail' => $this->detail,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at'=> $this->updated_at->format('Y-m-d'),
        ];
    }
}