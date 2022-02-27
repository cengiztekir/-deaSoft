<?php

namespace App\Services\Managers;

use App\Repositories\OrderItemRepository;

class OrderItemManager extends AbstractManager
{

    public function __construct(OrderItemRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'ORDERITEM';
    }
}
