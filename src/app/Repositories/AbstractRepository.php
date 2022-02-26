<?php

namespace App\Repositories;

use App\Exceptions\CustomException;
use App\Services\Managers\LogManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $result = $this->model->create($data); 

        $logManager = new LogManager();
        $logManager->storeLog(get_class($this->model), $this->checkResult($result), $data, NULL);

        return $result;
        
        return $this->model->create($data);
    }

    public function update(array $query, array $data)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        $result = $queryBuilder->update($data);

        $logManager = new LogManager();
        $logManager->storeLog(get_class($this->model), ['updated'=>$result], $data, $this->checkFilter($query)['filter']);

        return $result;
    }

    // sonuclarin ilkini getirir
    public function first(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        return $queryBuilder->first();
    }

    // sonuclarn hepsini getirir
    public function get(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        return $queryBuilder->get();
    }

    // sonuclari sayfalayarak getirir
    public function filter(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        return $queryBuilder
            ->paginate($query['limit'] ?? config("pagination.limit"), ["*"], "page", $query["page"] ?? 1);
    }

    protected function queryBuilder()
    {
        throw  new CustomException(__('QueryBuilder function not implemented for the repo about ').get_class($this));
    }

    public function delete(array $query)
    {
        try {
            $queryBuilder=$this->queryBuilder($query);

            $result = $queryBuilder->delete();

            $logManager = new LogManager();
            $logManager->storeLog(get_class($this->model), ['deleted'=>$result], NULL, $this->checkFilter($query)['filter']);

        }catch (QueryException $e){
            if ($e->getCode() == '23503'){
                throw new CustomException('FOREIGN_KEY_ERROR', 401);
            }
            else{
                throw new CustomException('DELETE_ERROR');
            }
        }
        
        return $result;
    }

    protected function checkFilter($data)
    {
        return isset($data['filter']) ? $data : ['filter' => $data];
    }

    protected function checkResult($result)
    {
        return $result ? $result->toArray() : [];
    }

}
