<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'hourly_rate' => config('app.currency').' '. $this->hourly_rate,
            'image_url'=>$this->image_url,
            'service_category'=> $this->serviceCategory ? $this->serviceCategory : null,
            'user'=> $this->user ? User::make($this->user) : null

        ];
    }
}
