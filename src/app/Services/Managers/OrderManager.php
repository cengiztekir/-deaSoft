<?php

namespace App\Services\Managers;

use App\Repositories\OrderRepository;

class OrderManager extends AbstractManager
{

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'ORDER';
    }
}
