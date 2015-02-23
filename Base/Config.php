<?php
namespace Base;

/**
 * Main configuration class
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
class Config
{
    /**
     * MySQL connection configuration
     * @return array
     */
    public function db()
    {
        return [
            'dsn' => 'mysql:dbname=vacancy;host=127.0.0.1',
            'user' => 'admin',
            'password' => 'qwer',
        ];
    }

    /**
     * routes config
     * @return array
     */
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