<?php

namespace App\Repositories;

use App\Models\Log;

class LogRepository
{

    public function __construct()
    {
        $this->model = new Log();
    }

    public function create(string $controllerName, int $userId, array $datas = NULL, array $result, array $filters = NULL, string $model, string $ip): string
    {
        $this->model->controller_name=$controllerName;
        $this->model->user_id=$userId;
        $this->model->datas=$datas;
        $this->model->filters=$filters;
        $this->model->result=$result;
        $this->model->model=$model;
        $this->model->ip=$ip;

        $this->model->save();

        return $this->model->id;
    }
}