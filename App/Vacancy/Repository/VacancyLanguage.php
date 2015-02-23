<?php
namespace App\Vacancy\Repository;

use Base\RepositoryStatic;

class VacancyLanguage extends RepositoryStatic
{
    public function __construct()
    {
    }

    public function staticData() {
        return [
            1 => ['id' => 1, 'lang' => 'en'],
            2 => ['id' => 2, 'lang' => 'ru'],
            3 => ['id' => 3, 'lang' => 'it'],
            4 => ['id' => 4, 'lang' => 'fr']
        ];
    }

    public function model()
    {
        return "\\App\\Vacancy\\Model\\VacancyLanguage";
    }
}