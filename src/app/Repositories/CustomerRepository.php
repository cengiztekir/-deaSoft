<?php

namespace App\Repositories;

use App\Models\Customer;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class CustomerRepository extends AbstractRepository
{

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Customer::class, new Request($query))
        ->allowedFilters([
            'name',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('since'),
            AllowedFilter::exact('revenue'),
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','name','since','revenue']);
    }
}
