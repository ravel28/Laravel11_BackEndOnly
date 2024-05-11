<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'email' => $this->email,
            'motto' => $this->motto,
            'age' => $this->age,
            'email_verified_at' => $this->email_verified_at,
            'remember_token' => $this->age,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
