<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Traits\HasFilterRequest;

class IndexRequest extends Request
{
    use HasFilterRequest {
        validated as traitValidated;
    }
}
