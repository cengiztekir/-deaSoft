<?php

namespace App\Http\Controllers\Product;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Services\Managers\ProductManager;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @param ProductManager $productManager
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $id, ProductManager $productManager): JsonResponse
    {
        $result=$productManager->updateModel(
            $id,
            $request->validated()
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'PRODUCT_UPDATED' : 'PRODUCT_NOT_UPDATED');

    }
}
