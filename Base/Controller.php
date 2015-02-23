<?php
namespace Base;

/**
 * Base Controller class
 *
 * @package    Base
 * @author     MikhailSI <oddisey@yandex.ru>
 * @version    Release: 0.1
 */
class Controller
{
    protected $view = [];

    protected $isAjax = false;
    /** @var \Base\App */
    protected $app;

    public function __construct(\Base\App $app)
    {
        $this->app = $app;
    }

    /**
     * Ajax response
     * @param array $params
     * @return string
     */
    public function ajax(array $params = [])
    {
        header('Content-Type: application/json');
        $this->isAjax = true;
        return json_encode($params);
    }

    /**
     * is ajax response?
     * @return bool
     */
    public function isAjax()
    {
        return $this->isAjax;
    }

    /**
     * assign var for use in template
     * @param $name
     * @param null $value
     */
    public function assign($name, $value = null)
    {
        $this->view[$name] = $value;
    }

    /**
     * get template vars
     * @return array
     */
    public function getView()
    {
        return $this->view;
    }
}