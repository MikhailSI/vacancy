<?php
namespace App\Vacancy\Repository;

use Base\RepositoryStatic;

class Department extends RepositoryStatic
{
    public function __construct()
    {
    }

    public function staticData() {
        return [
            1 => ['id' => 1, 'name' => 'Reserch & Development'],
            2 => ['id' => 2, 'name' => 'Administration'],
            3 => ['id' => 3, 'name' => 'Human Recruiting'],
        ];
    }

    public function model()
    {
        return "\\App\\Vacancy\\Model\\Department";
    }
}
