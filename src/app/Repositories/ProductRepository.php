<?php

namespace App\Repositories;

use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class ProductRepository extends AbstractRepository
{

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Product::class, new Request($query))
        ->allowedFilters([
            'name',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('category'),
            AllowedFilter::exact('price'),
            AllowedFilter::exact('stock'),
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','name','category','price', 'stock']);
    }
}
