<?php
namespace Base;

/**
 * Base model Class
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
class Model
{
    protected $params = [];

    /**
     * construct model
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
            $this->params[] = $key;
        }
    }

    /**
     * convert fields to array
     * @return array
     */
    public function toArray()
    {
        $result = [];

        foreach ($this->params as $param) {
            $result[$param] = isset($this->{$param}) ? $this->{$param} : null;
        }

        return $result;
    }
}