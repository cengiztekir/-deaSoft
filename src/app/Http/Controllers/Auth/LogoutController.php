<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogoutRequest;
use App\Services\Managers\AuthManager;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LogoutRequest $request
     * @param AuthManager $authManager
     * @return JsonResponse
     * @throws CustomException
     */
    public function __invoke(LogoutRequest $request, AuthManager $authManager): JsonResponse
    {
        $authManager->logout();

        return ApiResponse::message(true, 'LOGOUT_SUCCESSFUL');
    }
}
