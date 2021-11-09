<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => $this->user_type,
            'address' => $this->address,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'job' => $this->job,
            'date_of_birth' => $this->date_of_birth,
            'rate_score' => $this->rate_score,
        ];
    }
}
