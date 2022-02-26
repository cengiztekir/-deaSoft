<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\DeleteRequest;
use App\Services\Managers\CustomerManager;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @param CustomerManager $customerManager
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id, CustomerManager $customerManager): JsonResponse
    {
        $result = $customerManager->deleteModelById(
            $id
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'CUSTOMER_DELETED' : 'CUSTOMER_NOT_DELETED');

    }
}
