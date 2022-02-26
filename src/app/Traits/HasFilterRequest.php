<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait HasFilterRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => ['nullable'],
            'sort' => ['string'],
            'include' => ['array'],
            'fields' => ['string'],
            'page' => ['integer'],
            'limit' => ['integer']
        ];
    }

    public function validated()
    {
        return Arr::only(Parent::validated(), ["filter", "sort", "include", "fields", "page", "limit"]);
    }
}
