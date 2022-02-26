<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\Managers\AuthManager;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @param AuthManager $authManager
     * @return JsonResponse
     * @throws CustomException
     */

    public function __invoke(LoginRequest $request, AuthManager $authManager): JsonResponse
    {
        $token = $authManager->login($request->validated());

        return ApiResponse::data([
            'data' => new AuthResource($authManager->getAuthUser()),
            'access_token' => $token,
            'type' => 'Bearer'
        ]);
    }
}
