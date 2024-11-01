<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OTP extends JsonResource
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
            // 'id' => (string)$this->id,
            'otp' => $this->otp,
            // 'phone' => $this->phone,
            // 'country_code' => $this->country_code,
            'expires_at' => $this->expires_at ? $this->expires_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
