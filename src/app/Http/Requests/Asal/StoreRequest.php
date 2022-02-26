<?php

namespace App\Http\Requests\Asal;

use App\Http\Requests\Request;
use App\Rules\TcNationalIdRule;

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
            'student_program_id' => ['required', 'integer', 'exists:student_programs,id'],
            'national_id' => ['required', 'string', 'digits:11', new TcNationalIdRule()],
            'yoksis_unit_id' => ['required', 'integer', 'exists:yoksis_units,id'],
            'request_type' => ['required', 'string', 'in:E,I'],
            'request_reason' => ['required', 'string', 'max:3'],
            'reason_to_increase_max_duration' => ['nullable', 'string', 'max:500'],
            'extra_time' => ['nullable', 'integer', 'between:0,255'],
            'signer_national_id' => ['required', 'string', 'digits:11', new TcNationalIdRule()],
            'signer_name_surname' => ['required', 'string', 'max:50']
        ];
    }

}
