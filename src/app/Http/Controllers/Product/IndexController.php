<?php

namespace App\Http\Controllers\Product;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Resources\ProductResource;
use App\Services\Managers\ProductManager;
use App\Traits\HasPagination;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param ProductManager $productManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(IndexRequest $request, ProductManager $productManager): JsonResponse
    {
        $result = $productManager->getModels(
            $request->all()
        );

        return ApiResponse::pagination(ProductResource::collection($result), $this->paginate($result));
    }
}
