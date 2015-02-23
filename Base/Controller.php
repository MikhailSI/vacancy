<?php
namespace Base;

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

    public function ajax(array $params)
    {
        header('Content-Type: application/json');
        $this->isAjax = true;
        return json_encode($params);
    }

    public function isAjax()
    {
        return $this->isAjax;
    }

    public function assign($name, $value = null)
    {
        $this->view[$name] = $value;
    }

    public function getView()
    {
        return $this->view;
    }
}