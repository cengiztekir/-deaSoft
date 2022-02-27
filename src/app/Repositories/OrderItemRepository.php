<?php

namespace App\Repositories;

use App\Models\OrderItem;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class OrderItemRepository extends AbstractRepository
{

    public function __construct(OrderItem $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(OrderItem::class, new Request($query))
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('order_id'),
            AllowedFilter::exact('product_id'),
            AllowedFilter::exact('quantity'),
            AllowedFilter::exact('unit_price'),
            AllowedFilter::exact('total')
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','product_id','quantity','unit_price','total']);
    }
}
