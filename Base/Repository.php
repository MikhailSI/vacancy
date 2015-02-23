<?php
namespace Base;

abstract class Repository
{
    /** @var \PDO  */
    protected $driver = null;

    abstract public function table();

    /*
     * @return string
     */
    abstract public function model();

    public function __construct(\PDO $driver)
    {
        $this->driver = $driver;
    }

    public function prepareExecute($query, $data = [])
    {
        $statement = $this->driver->prepare($query);
        $statement->execute($data);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function newModel($params)
    {
        $model = $this->model();
        return new $model($params);
    }

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
