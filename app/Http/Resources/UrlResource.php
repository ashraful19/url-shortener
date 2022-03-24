<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UrlResource extends JsonResource
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
            'long_url' => $this->long_url,
            'short_code' => $this->short_code,
            'short_url' => URL::to($this->short_code),
            'created_at' => (string) $this->created_at,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
