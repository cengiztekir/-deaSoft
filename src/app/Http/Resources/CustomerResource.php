<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed since
 * @property mixed revenue
 */
class CustomerResource extends JsonResource
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
            'since' => $this->since,
            'revenue' => $this->revenue
        ];
    }
}
