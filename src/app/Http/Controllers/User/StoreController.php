<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Services\Managers\UserManager;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @param UserManager $userManager
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request, UserManager $userManager): JsonResponse
    {
        $result = $userManager->storeModel(
            $request->validated()
        );

        return ApiResponse::message(true, 'USER_CREATED', new UserResource($result));

    }
}
