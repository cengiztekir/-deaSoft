<?php

namespace App\Services\Managers;

use App\Exceptions\CustomException;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthManager
{

    private $user;
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->user = FacadesAuth::user();
        $this->userRepo = $userRepo;
    }

    public function login(array $credentials)
    {
        try {
            $credentials['status'] = 'a';

            if (!FacadesAuth::attempt($credentials)) {
                throw new CustomException(__('Giriş bilgileri yanlış.'));
            }
    
            $this->user = FacadesAuth::user();
            $tokenResult = $this->user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
    
            $data = [
                'last_login_at' => Carbon::now('Europe/Istanbul')->toDateTimeString()
            ];
    
            $this->userRepo->update([
                'id' => $this->user->id
            ], $data);
        } catch (Exception $e) {
            $message = 'LOGIN_SYSTEM_FAIL';
            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog('USER', $message, $credentials, $e);
            throw new CustomException($message);
        }

        return $token;
    }

    public function getAuthUser(){
        return $this->user;
    }

    public function logout()
    {
        $this->getAuthUser()->tokens()->delete();
    }
}
