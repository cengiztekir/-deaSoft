<?php

namespace App\Http\Controllers\User;

use App\Exceptions\CustomException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShowRequest;
use App\Http\Resources\UserResource;
use App\Services\Managers\UserManager;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ShowRequest $request
     * @param int $id
     * @param UserManager $userManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(ShowRequest $request, int $id, UserManager $userManager): JsonResponse
    {
        $user = $userManager->getModel(
            $id
        );

        return ApiResponse::data(new UserResource($user));

    }
}
