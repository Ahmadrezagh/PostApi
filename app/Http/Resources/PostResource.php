<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class PostResource extends JsonResource
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
            'postTitle' => $this->title,
            'postContent' => $this->content,
            'postCreatedAt' => \Morilog\Jalali\Jalalian::forge($this->created_at)->format('%A, %d %B %Y')
        ];
    }
}
