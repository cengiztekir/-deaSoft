<?php

namespace App\Http\Controllers\Order;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\OrderResource;
use App\Services\Managers\OrderManager;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @param OrderManager $orderManager
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request, OrderManager $orderManager): JsonResponse
    {
        $result = $orderManager->storeModel(
            $request->validated()
        );

        return ApiResponse::message(true, 'ORDER_CREATED', new OrderResource($result));

    }
}
