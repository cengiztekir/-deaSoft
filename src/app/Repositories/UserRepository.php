<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class UserRepository extends AbstractRepository
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(User::class, new Request($query))
        ->allowedFilters([
            'name',
            'surname',
            'email',
            AllowedFilter::exact('status'),
            AllowedFilter::exact('id'),
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','name','surname','email','created_at','last_login_at','status']);
    }
}
