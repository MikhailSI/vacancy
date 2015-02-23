<?php
namespace Base;

/**
 * Static repository
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
abstract class RepositoryStatic
{
    /**
     * get static data
     * @return array
     */
    abstract protected function staticData();

    /**
     * get model class name
     * @return string
     */
    abstract public function model();

    /**
     * create new model with params
     * @param $params
     * @return mixed
     */
    public function newModel($params)
    {
        $model = $this->model();
        return new $model($params);
    }

    /**
     * get model by id
     * @param $id
     * @return bool|mixed
     */
    public function getById($id)
    {
        return isset($this->staticData()[(int) $id]) ? $this->newModel($this->staticData()[(int) $id]) : false;
    }

    /**
     * get models for all stored data
     * @return array
     */
    public function all()
    {
        $result = [];

        foreach ($this->staticData() as $item) {
            $result[] = $this->newModel($item);
        }

        return $result;
    }
}