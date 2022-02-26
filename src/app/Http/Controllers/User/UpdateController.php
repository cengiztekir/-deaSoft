<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Services\Managers\UserManager;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @param UserManager $userManager
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, int $id, UserManager $userManager): JsonResponse
    {
        $result=$userManager->updateModel(
            $id,
            $request->validated()
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'USER_UPDATED' : 'USER_NOT_UPDATED');

    }
}
