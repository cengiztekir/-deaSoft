<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeleteRequest;
use App\Services\Managers\UserManager;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param DeleteRequest $request
     * @param int $id
     * @param UserManager $userManager
     * @return JsonResponse
     */
    public function __invoke(DeleteRequest $request, int $id, UserManager $userManager): JsonResponse
    {
        $result = $userManager->deleteModelById(
            $id
        );

        return ApiResponse::message($result > 0, $result > 0 ? 'USER_DELETED' : 'USER_NOT_DELETED');

    }
}
