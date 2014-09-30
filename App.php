<?php

use Globals\Classes\App\Identity;
use Globals\Classes\Db;
use Models\Users;

class App
{
    /** @var Db */
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

    private $viewMap = [
        'header'=> '',
        'content' => '',
        'footer' => ''
    ];

    /** @var Identity */
    private $identity;

    private static $app;

    private function __construct(array $configs = [])
    {
        $this->configs = $configs;
        $this->initDb();
        $this->initGlobals();
    }

    /**
     * @param array $configs
     * @return App
     */
    public static function getApp(array $configs = [])
    {
        if (!self::$app) {
            self::$app = new self($configs);
        }
        return self::$app;
    }

    public function start()
    {
        $this->initIdentity();
        $this->initRouting();
        $this->initContent();
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    /** @return Db */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return Identity
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    private function initContent()
    {
        $array = [
            'header' => 'views/header.php',
            'content' => '',
            'footer' => 'views/footer.php'
        ];

        $this->viewMap['content'] = ($this->controller && $this->action)
            ? $this->controller->$this->action($this->post, $this->get, $this->files)
            : include 'views/notfound.php';
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
        ob_start();
        foreach($this->viewMap as $view){
            include $view;
        }
        echo ob_get_clean();
    }

    private function initRouting()
    {

    }

    private function initIdentity()
    {
        $id = isset($this->session['USER_SESSION_ID'])
            ? $this->session['USER_SESSION_ID']
            : 0;
        $this->identity = new Identity($id);
    }

    private function initDb()
    {
        $this->db = Db::getDb($this->getConfig('db'));
    }

    public function getConfig($configKey, $default = null)
    {
        if (isset($this->configs[$configKey])) {
            $default = $this->configs[$configKey];
        }
        return $default;
    }
} 