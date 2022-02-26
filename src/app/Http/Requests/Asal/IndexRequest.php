<?php

namespace App\Http\Requests\Asal;

use App\Http\Requests\Request;
use App\Traits\HasFilterRequest;

class IndexRequest extends Request
{
    use HasFilterRequest {
        validated as traitValidated;
    }
}
