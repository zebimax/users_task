<?php

namespace Globals\Classes\App;


class Route
{
    private $controller;
    private $action;
    private $uri;
    private $routes = [];
    private $modules = [];
    private $route;

    public function __construct($uri, array $routes = [], array $modules = [])
    {
        $this->routes = $routes;
        $this->modules = $modules;
        $this->parseUri($uri);
        $this->initController();
        $this->initAction();
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    private function initController()
    {
        if(isset($this->routes[$this->uri[0]])) {
            $this->route = $this->routes[$this->uri[0]];
        }
        if(isset($this->route['module'])) {
            $this->controller = $this->route['module'];
        }
    }

    private function initAction()
    {

    }

    private function parseUri($uri)
    {
        $this->uri = explode('/', ltrim($uri , '/'));
    }
}