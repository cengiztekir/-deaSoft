<?php

namespace App\Http\Controllers\Order;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Resources\OrderResource;
use App\Services\Managers\OrderManager;
use App\Traits\HasPagination;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param OrderManager $orderManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(IndexRequest $request, OrderManager $orderManager): JsonResponse
    {
        $result = $orderManager->getModels(
            $request->all()
        );

        return ApiResponse::pagination(OrderResource::collection($result), $this->paginate($result));
    }
}
