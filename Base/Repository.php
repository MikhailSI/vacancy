<?php
namespace Base;

/**
 * Repository class
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
abstract class Repository
{
    /** @var \PDO  */
    protected $driver = null;

    /** table */
    abstract public function table();

    /**
     * get model class name
     * @return string
     */
    abstract public function model();

    public function __construct(\PDO $driver)
    {
        $this->driver = $driver;
    }

    /**
     * prepare query and execute it with params
     * @param $query
     * @param array $data
     * @return array
     */
    public function prepareExecute($query, $data = [])
    {
        $statement = $this->driver->prepare($query);
        $statement->execute($data);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * return new model
     * @param $params
     * @return mixed
     */
    public function newModel($params)
    {
        $model = $this->model();
        return new $model($params);
    }

    /**
     * return model for all stored data
     * @return array
     */
    public function all()
    {
        $qResult = $this->prepareExecute("SELECT * FROM {$this->table()} AS t");
        $result = [];

        foreach ($qResult as $item) {
            $result[] = $this->newModel($item);
        }

        return $result;
    }
}
