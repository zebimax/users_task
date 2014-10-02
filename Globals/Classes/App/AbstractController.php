<?php

namespace Globals\Classes\App;

class AbstractController
{
    protected $action;

    protected $post = [];
    protected $get = [];
    protected $files = [];

    public function dispatch()
    {
        $response = null;
        if (method_exists($this, $this->action . 'Action')) {
            $response = $this->$this->action();
        }
        return $response;
    }

    public function getDefaultViewModel()
    {

    }
}