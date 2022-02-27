<?php

namespace App\Repositories;

use App\Models\Campaign;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;

class CampaignRepository extends AbstractRepository
{

    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Campaign::class, new Request($query))
        ->allowedFilters([
            'reasonn',
            AllowedFilter::exact('id'),
            AllowedFilter::exact('type'),
            AllowedFilter::exact('category'),
            AllowedFilter::exact('min_quantity'),
            AllowedFilter::exact('discount_quantity'),
            AllowedFilter::exact('min_amount'),
            AllowedFilter::exact('discount_rate'),  
            AllowedFilter::scope('greater_than_min_amount')
        ])
        ->defaultSort('-id')
        ->allowedSorts(['id','type','category','min_quantity','discount_quantity','min_amount','discount_rate']);
    }
}