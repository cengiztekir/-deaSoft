<?php

namespace App\Services\Managers;

use App\Repositories\CustomerRepository;

class CustomerManager extends AbstractManager
{

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'CUSTOMER';
    }
}
