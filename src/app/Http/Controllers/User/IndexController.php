<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Http\Resources\UserResource;
use App\Services\Managers\UserManager;
use App\Traits\HasPagination;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param UserManager $userManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(IndexRequest $request, UserManager $userManager): JsonResponse
    {
        $result = $userManager->getModels(
            $request->all()
        );

        return ApiResponse::pagination(UserResource::collection($result), $this->paginate($result));
    }
}
