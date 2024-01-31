<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
            'deleted_at' => $this->deleted_at ? Carbon::parse($this->deleted_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') : null,
        ];
    }
}
