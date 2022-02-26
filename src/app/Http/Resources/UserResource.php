<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed surname
 * @property mixed full_name
 * @property mixed email
 * @property mixed status
 * @property mixed last_login_at
 */
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
            'surname' => $this->surname,
            'full_name' => $this->name.' '.$this->surname,
            'email' => $this->email,
            'status' => $this->status,
            'last_login_at' => $this->last_login_at
        ];
    }
}
