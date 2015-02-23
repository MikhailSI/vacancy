<?php
namespace App\Vacancy\Model;

class Department extends \Base\Model
{
    protected $id;
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        return $this->id = (int) $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        return $this->name = $value;
    }
}