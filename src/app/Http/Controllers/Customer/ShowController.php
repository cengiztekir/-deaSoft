<?php

namespace App\Http\Controllers\Customer;

use App\Exceptions\CustomException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ShowRequest;
use App\Http\Resources\CustomerResource;
use App\Services\Managers\CustomerManager;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @param int $id
     * @param CustomerManager $customerManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(ShowRequest $request, int $id, CustomerManager $customerManager): JsonResponse
    {
        $customer = $customerManager->getModel(
            $id
        );

        return ApiResponse::data(new CustomerResource($customer));

    }
}
