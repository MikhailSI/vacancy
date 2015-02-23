<?php
namespace Base;

abstract class RepositoryStatic
{
    /**
     * @return array
     */
    abstract protected function staticData();

    /**
     * @return string
     */
    abstract public function model();

    public function newModel($params)
    {
        $model = $this->model();
        return new $model($params);
    }

    public function getById($id)
    {
        return isset($this->staticData()[(int) $id]) ? $this->newModel($this->staticData()[(int) $id]) : false;
    }

    public function all()
    {
        $result = [];

        foreach ($this->staticData() as $item) {
            $result[] = $this->newModel($item);
        }

        return $result;
    }
}