<?php
namespace App\Vacancy\Model;

use Base\Model;

class VacancyLanguage extends Model
{
    protected $id;
    protected $lang;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        return $this->id = (int) $value;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setLang($value)
    {
        return $this->lang = $value;
    }
}