<?php

namespace App\Repositories;

use App\Models\Order;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class OrderRepository extends AbstractRepository
{

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Order::class, new Request($query))
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('customer_id'),
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','customer_id']);
    }
}
