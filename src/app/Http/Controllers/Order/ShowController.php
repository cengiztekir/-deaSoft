<?php

namespace App\Http\Controllers\Order;

use App\Exceptions\CustomException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ShowRequest;
use App\Http\Resources\OrderResource;
use App\Services\Managers\OrderManager;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @param int $id
     * @param OrderManager $orderManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(ShowRequest $request, int $id, OrderManager $orderManager): JsonResponse
    {
        $order = $orderManager->getModel(
            $id
        );

        return ApiResponse::data(new OrderResource($order));

    }
}
