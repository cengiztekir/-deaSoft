<?php

namespace App\Http\Controllers\Product;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Services\Managers\ProductManager;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @param ProductManager $productManager
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request, ProductManager $productManager): JsonResponse
    {
        $result = $productManager->storeModel(
            $request->validated()
        );

        return ApiResponse::message(true, 'PRODUCT_CREATED', new ProductResource($result));

    }
}
