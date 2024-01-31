<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user'),
            'category' => $this->whenLoaded('category'),
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'deleted_at' => $this->deleted_at ? Carbon::parse($this->deleted_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
        ];
    }
}
