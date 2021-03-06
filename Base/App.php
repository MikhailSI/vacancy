<?php
namespace Base;

/**
 * Base App class
 *
 * Main application class. Use for generate repositories, models, render views etc.
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
class App
{
    private static $instance = null;

    private $reflectionCache = [];

    /**
     * @var \Base\Config
     */
    private $config = null;
    private $driver = null;

    /**
     * Return instance of Application
     * @return \Base\App
     */
    public static function i()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    /**
     * load application config and init base components
     * @param Config $config
     * @return $this
     */
    public function configure(\Base\Config $config)
    {
        $this->config = $config;
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $this->driver = new \PDO($this->config->db()['dsn'], $this->config->db()['user'], $this->config->db()['password'], $options);
        return $this;
    }

    /**
     * generate new instance of class with parameters
     * @param $objectClass
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function object($objectClass, array $params = [])
    {
        if (class_exists($objectClass)) {
            if (!isset($this->reflectionCache[$objectClass])) {
                $this->reflectionCache[$objectClass] = new \ReflectionClass($objectClass);
            }

            return $this->reflectionCache[$objectClass]->newInstanceArgs($params);
        } else {
            throw new \Exception("Unknown class name \"{$objectClass}\"");
        }
    }

    /**
     * get current route config
     * @param string $route
     * @return mixed
     * @throws \Exception
     */
    public function router($route = '/')
    {
        $routes = $this->config->routing();

        foreach ($routes as $routeExp => $params) {
            if (preg_match("~^{$routeExp}~", $route)) {
                return $params;
            }
        }

        throw new \Exception('Action not recognized!');
    }

    public function getController($name, $module = null)
    {
        if (!$module) {
            $module = $this->module;
        }

        return $this->object("\\App\\{$module}\\Controller\\{$name}", [$this]);
    }

    public function getRepository($name, $module = '')
    {
        if (!$module) {
            $module = $this->module;
        }

        return $this->object("\\App\\{$module}\\Repository\\{$name}", [$this->driver]);
    }

    public function getModel($name, $module = '')
    {
        if (!$module) {
            $module = $this->module;
        }

        return $this->object("\\App\\{$module}\\Model\\{$name}");
    }

    public function getTemplate($name, $module = null)
    {
        if (!$module) {
            $module = $this->module;
        }

        return ".." . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR . $name . ".phtml";
    }

    /**
     * processing request
     */
    public function start()
    {
        try {
            header('Content-Type: text/html; charset=utf-8');
            $route = $_SERVER['REQUEST_URI'];
            $router = $this->router($route);
            $module = $router['module'];
            $this->module = $module;
            /** @var \Base\Controller $controller */
            $controller = $this->getController($router['ctrl']);
            $result = "";

            if (method_exists($controller, $router['action'] . 'Action')) {
                $result = $controller->{$router['action'] . 'Action'}();
            }

            if (!($controller->isAjax())) {
                echo $this->render($controller, $this->getTemplate($router['action']));
            } else {
                echo $result;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * render template
     * @param $controller
     * @param $template
     * @return string
     */
    protected function render($controller, $template)
    {
        ob_start();
        extract($controller->getView());
        include ".." . DIRECTORY_SEPARATOR . "Base" . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR . "index.phtml";
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}