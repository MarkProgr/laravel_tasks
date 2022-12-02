<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalUserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'status' => $this->status,
            'image_name' => $this->image_name,
        ];
    }
}
