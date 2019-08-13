<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Links extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'long_url' => $this->long_url,
            'short_url' => $this->short_url,
            'modified_url' => url('/').'/'.$this->short_url,
            'clicks' => $this->clicks,
            'expire_at' => $this->expire_at,
            'is_expired' => $this->is_expired,
            'created_at' => $this->created_at,
            'is_deleted' => $this->deleted_at?true:false
        ];
    }
}
