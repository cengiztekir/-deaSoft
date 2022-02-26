<?php

namespace App\Services\Managers;

use App\Repositories\ProductRepository;

class ProductManager extends AbstractManager
{

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'PRODUCT';
    }
}
