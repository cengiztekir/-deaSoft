<?php


namespace App\Services\Managers;


use App\Exceptions\CustomException;
use Exception;
use Illuminate\Support\Str;

class AbstractManager
{
    protected $repository;
    protected $modelName;

    public function getModels(array $query = null)
    {
        try {
            $models = $this->repository->filter($query);
        } catch (Exception $e) {
            $message = sprintf('%s_SYSTEM_FAIL',Str::upper($this->modelName));

            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $query, $e->getMessage());

            throw new CustomException($message);
        }
        
        return $models;
    }

    public function getModel(int $id, array $query = null)
    {
        try {
            $query['filter']['id'] = $id;
            $model = $this->repository->first($query); 
        } catch (Exception $e) {
            $message = sprintf('%s_SYSTEM_FAIL',Str::upper($this->modelName));
            
            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $query, $e->getMessage());

            throw new CustomException($message);
        }

        if (!$model) {
            $message = sprintf('%s_NOT_FOUND',Str::upper($this->modelName));
            throw new CustomException($message);
        }   
        
        return $model;
    }

    public function storeModel(array $data)
    {
        try {
            $model = $this->repository->create($data)->refresh();
        } catch (Exception $e) {
            $message = sprintf('%s_NOT_CREATED',Str::upper($this->modelName));

            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $data, $e->getMessage());

            throw new CustomException($message);
        }
        
        return $model;
    }

    public function updateModel(int $id, array $data)
    {
        try {
            $query['filter']['id'] = $id;

            $result = $this->repository->update($query, $data);
        } catch (Exception $e) {
            $message = sprintf('%s_NOT_UPDATED',Str::upper($this->modelName));

            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $data, $e->getMessage());

            throw new CustomException($message);
        }
        
        return $result;
    }

    public function deleteModelById(int $id)
    {
        try {
            $query['filter']['id'] = $id;

            $result = $this->repository->delete($query);
        } catch (Exception $e) {
            $message = sprintf('%s_NOT_DELETED',Str::upper($this->modelName));

            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $query, $e->getMessage());

            throw new CustomException($message);
        }
        
        return $result;
    }

    public function findModels(array $query = null)
    {
        try {
            $models = $this->repository->get($query);
        } catch (Exception $e) {
            $message = sprintf('%s_SYSTEM_FAIL',Str::upper($this->modelName));

            $errorLogManager = new ErrorLogManager();
            $errorLogManager->storeLog(Str::upper($this->modelName), $message, $query, $e->getMessage());

            throw new CustomException($message);
        }

        return $models;

    }
}
