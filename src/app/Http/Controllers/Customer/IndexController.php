<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\IndexRequest;
use App\Http\Resources\CustomerResource;
use App\Services\Managers\CustomerManager;
use App\Traits\HasPagination;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param CustomerManager $customerManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(IndexRequest $request, CustomerManager $customerManager): JsonResponse
    {
        $result = $customerManager->getModels(
            $request->all()
        );

        return ApiResponse::pagination(CustomerResource::collection($result), $this->paginate($result));
    }
}
