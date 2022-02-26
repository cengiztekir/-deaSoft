<?php

namespace App\Services\Managers;

use App\Repositories\ErrorLogRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class ErrorLogManager
{
    public function __construct()
    {
        $this->errorLogRepository = new ErrorLogRepository();
    }

    public function storeLog(string $model, string $errorKey, array $datas = NULL, $result): string
    {
        $route = Route::current();
        $controller=explode('\\',$route->getActionName());
        unset($controller[0],$controller[1],$controller[2]);
        $controllerName = implode('\\',$controller);

        $modelClass = explode('\\',$model);
        $modelName = end($modelClass);

        return $this->errorLogRepository->create(
            $controllerName,
            $errorKey,
            Auth::user()->id??0,
            $datas,
            $result,
            $modelName,
            Request::ip()??0
        );
    }
}