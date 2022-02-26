<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateRequest;
use App\Services\Managers\CustomerManager;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @param CustomerManager $customerManager
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $id, CustomerManager $customerManager): JsonResponse
    {
        $result=$customerManager->updateModel(
            $id,
            $request->validated()
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'CUSTOMER_UPDATED' : 'CUSTOMER_NOT_UPDATED');

    }
}
