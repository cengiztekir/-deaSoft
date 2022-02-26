<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed id
 * @property mixed name
 * @property mixed surname
 * @property mixed full_name
 * @property mixed email
 */
class AuthResource extends JsonResource
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
        ];
    }
}
