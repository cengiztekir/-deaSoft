<?php

namespace App\Http\Controllers\Product;

use App\Exceptions\CustomException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowRequest;
use App\Http\Resources\ProductResource;
use App\Services\Managers\ProductManager;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @param int $id
     * @param ProductManager $productManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(ShowRequest $request, int $id, ProductManager $productManager): JsonResponse
    {
        $product = $productManager->getModel(
            $id
        );

        return ApiResponse::data(new ProductResource($product));

    }
}
