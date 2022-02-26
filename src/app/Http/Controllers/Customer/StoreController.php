<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Resources\CustomerResource;
use App\Services\Managers\CustomerManager;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @param CustomerManager $customerManager
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request, CustomerManager $customerManager): JsonResponse
    {
        $result = $customerManager->storeModel(
            $request->validated()
        );

        return ApiResponse::message(true, 'CUSTOMER_CREATED', new CustomerResource($result));

    }
}
