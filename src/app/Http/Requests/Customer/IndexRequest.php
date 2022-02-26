<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\Request;
use App\Traits\HasFilterRequest;

class IndexRequest extends Request
{
    use HasFilterRequest {
        validated as traitValidated;
    }
}
