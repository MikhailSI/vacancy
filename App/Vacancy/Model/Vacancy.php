<?php
namespace App\Vacancy\Model;

use Base\Model;

class Vacancy extends Model
{
    protected $id;
    protected $name;
    protected $desc;
    protected $dept_id;
    protected $lang = 1;
    protected $department;
    protected $language;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getDeptId()
    {
        return $this->dept_id;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setId($value)
    {
        return $this->id = (int) $value;
    }

    public function setName($value)
    {
        return $this->name = $value;
    }

    public function setDesc($value)
    {
        return $this->desc = $value;
    }

    public function setDeptId($value)
    {
        return $this->dept_id = (int) $value;
    }

    public function setLang($value)
    {
        return $this->lang = $value;
    }

    public function getLanguage()
    {
        if (!$this->language) {
            $this->language = \Base\App::i()->getRepository('VacancyLanguage')->getById($this->lang);
        }

        return is_object($this->language) ? $this->language->getLang() : $this->lang;
    }

    public function getDepartment()
    {
        if (!$this->department) {
            $this->department = \Base\App::i()->getRepository('Department')->getById($this->dept_id);
        }

        return is_object($this->department) ? $this->department->getName() : $this->dept_id;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'desc' => $this->getDesc(),
            'department' => $this->getDepartment(),
            'language' => $this->getLanguage(),
        ];
    }
}
