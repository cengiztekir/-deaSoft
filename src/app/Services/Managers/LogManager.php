<?php

namespace App\Services\Managers;

use App\Repositories\LogRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class LogManager
{
    public function __construct()
    {
        $this->logRepo = new LogRepository();
    }

    public function storeLog(string $model, array $result, array $datas = NULL, array $filters = NULL): string
    {
        $route = Route::current();
        $controller=explode('\\',$route->getActionName());
        unset($controller[0],$controller[1],$controller[2]);
        $controllerName = implode('\\',$controller);

        $modelClass = explode('\\',$model);
        $modelName = end($modelClass);

        return $this->logRepo->create(
            $controllerName,
            Auth::user()->id??0,
            $datas,
            $result,
            $filters,
            $modelName,
            Request::ip()??0
        );
    }
}