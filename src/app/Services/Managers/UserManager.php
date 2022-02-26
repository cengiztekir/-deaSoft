<?php

namespace App\Services\Managers;

use App\Repositories\UserRepository;

class UserManager extends AbstractManager
{

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'USER';
    }
}
