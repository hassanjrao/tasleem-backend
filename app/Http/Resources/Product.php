<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'id' => (string)$this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => config('app.currency').' '. $this->price,
            'category'=> $this->productCategory ? $this->productCategory : null,
            'user'=> $this->user ? User::make($this->user) : null,
            'images'=> $this->productImages ? $this->productImages->pluck('image_url') : []
        ];
    }
}
