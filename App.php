<?php

class App
{
    private $db;
    private $header;
    private $footer;
    private $content;
    private $configs = [];

    private $post = [];
    private $get = [];
    private $files = [];
    private $session = [];

    private $controller;
    private $action;

    private static $app;

    private function __construct(array $configs = [])
    {
        $this->configs = $configs;
        $this->initDb();
        $this->header = include 'views/header.php';
        $this->footer = include 'views/footer.php';
        $this->initGlobals();
    }

    public static function getApp(array $configs = [])
    {
        if (!self::$app) {
            self::$app = new self($configs);
        }
        return self::$app;
    }

    public function start()
    {
        $this->initRouting();
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    private function initContent()
    {
        $this->content = ($this->controller && $this->action)
            ? $this->controller->$this->action($this->post, $this->get, $this->files)
            : include 'views/notfound.php';


        ;
    }

    private function initGlobals()
    {
        session_start();
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
        $this->session = $_SESSION;
    }

    private function render()
    {
        echo $this->header . $this->content . $this->footer;
    }

    private function initRouting()
    {

    }

    private function initDb()
    {
        $this->db = Db::getDb(get_global_config('db'));
    }
} 