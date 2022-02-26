<?php

namespace App\Http\Controllers\Product;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteRequest;
use App\Services\Managers\ProductManager;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @param ProductManager $productManager
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id, ProductManager $productManager): JsonResponse
    {
        $result = $productManager->deleteModelById(
            $id
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'PRODUCT_DELETED' : 'PRODUCT_NOT_DELETED');

    }
}
