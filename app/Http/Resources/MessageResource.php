<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'to' => $this->to,
            'from' => $this->from,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d/m/Y H:i')
        ];
    }
}
