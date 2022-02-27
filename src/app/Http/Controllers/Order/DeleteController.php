<?php

namespace App\Http\Controllers\Order;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DeleteRequest;
use App\Services\Managers\OrderManager;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @param OrderManager $orderManager
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id, OrderManager $orderManager): JsonResponse
    {
        $result = $orderManager->deleteModelById(
            $id
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'ORDER_DELETED' : 'ORDER_NOT_DELETED');

    }
}
