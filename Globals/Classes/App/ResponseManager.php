<?php

namespace Globals\Classes\App;

class ResponseManager
{
    private $controller;
    public function __construct(AbstractController $controller)
    {
        $this->controller = $controller;
    }

    private function selectViewModel()
    {

    }
} 