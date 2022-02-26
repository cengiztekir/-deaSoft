<?php

namespace App\Repositories;

use App\Models\ErrorLog;

class ErrorLogRepository
{

    public function __construct()
    {
        $this->model = new ErrorLog();
    }

    public function create(string $controllerName, string $errorKey, int $userId, array $datas = NULL, $result, string $model, string $ip): string
    {
        $this->model->controller_name=$controllerName;
        $this->model->error_key=$errorKey;
        $this->model->user_id=$userId;
        $this->model->datas=$datas;
        $this->model->result=$result;
        $this->model->model=$model;
        $this->model->ip=$ip;

        $this->model->save();

        return $this->model->id;
    }
}