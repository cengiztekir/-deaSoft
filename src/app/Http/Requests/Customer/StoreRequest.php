<?php

namespace App\Http\Requests\Customer;

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
            'name' => ['required', 'string', 'max:100'],
            'since' => ['required', 'date-format:Y-m-d'],
            'revenue' => ['required', 'numeric']
        ];

    }
}
