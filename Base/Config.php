<?php
namespace Base;

class Config
{
    public function db()
    {
        return [
            'dsn' => 'mysql:dbname=vacancy;host=127.0.0.1',
            'user' => 'root',
            'password' => 'qwer',
        ];
    }

    public function routing()
    {
        return [
            '/filter/.*' => [
                'module' => 'Vacancy',
                'ctrl' => 'Index',
                'action' => 'filter',
                'params' => []
            ],
            '/.*' => [
                'module' => 'Vacancy',
                'ctrl' => 'Index',
                'action' => 'index',
                'params' => []
            ],
        ];
    }
}