<?php

namespace App\Http\Controllers\Order;

use App\Exceptions\CustomException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DiscountRequest;
use App\Services\Managers\OrderManager;
use Illuminate\Http\JsonResponse;

class DiscountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param DiscountRequest $request
     * @param int $id
     * @param OrderManager $orderManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(DiscountRequest $request, int $id, OrderManager $orderManager): JsonResponse
    {
        $result = $orderManager->calculateDiscounts(
            $id
        );

        return ApiResponse::data($result);

    }
}
