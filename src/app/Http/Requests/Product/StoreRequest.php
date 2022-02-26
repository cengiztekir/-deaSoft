<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:500'],
            'category' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'integer']
        ];
        
    }
}
