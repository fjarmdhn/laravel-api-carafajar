<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'post' => $this->whenLoaded('post', new PostResource($this->post)),
            'user' => $this->whenLoaded('user', new UserResource($this->user)),
            'comment' => $this->comment,
            'slug' => $this->slug,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'deleted_at' => $this->deleted_at ? Carbon::parse($this->deleted_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
        ];
    }
}
