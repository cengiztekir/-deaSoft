<?php

namespace App\Http\Controllers\Order;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateRequest;
use App\Services\Managers\OrderManager;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @param OrderManager $orderManager
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $id, OrderManager $orderManager): JsonResponse
    {
        $result=$orderManager->updateModel(
            $id,
            $request->validated()
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'ORDER_UPDATED' : 'ORDER_NOT_UPDATED');

    }
}
