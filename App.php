<?php

use Globals\Classes\App\Identity;
use Globals\Classes\App\Renderer;
use Globals\Classes\App\Route;
use Globals\Classes\Db;
use Models\Users;

class App
{
    /** @var Db */
    private $db;
    private $configs = [];

    private $post = [];
    private $get = [];
    private $files = [];
    private $session = [];

    /** @var Route */
    private $route;
    /** @var Renderer */
    private $renderer;
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
        $this->createResponse();
        $this->initRendering();
        $this->render();
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

    private function initRendering()
    {
//        $result = ($this->controller && $this->action)
//            ? $this->controller->$this->action($this->post, $this->get, $this->files)
//            : include 'views/notfound.php';
        $this->renderer = new Renderer($this->route);
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
        $this->renderer->render();
//        ob_start();
//        foreach($this->viewMap as $view){
//            include $view;
//        }
//        echo ob_get_clean();
    }

    private function initRouting()
    {
        $this->route = new Route(
            $_SERVER['REQUEST_URI'],
            $this->getConfig('routes'),
            $this->getConfig('modules')
        );
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

    private function createResponse()
    {
        new ResponseManager(
            $this->route->getController()
        );
    }

    public function getConfig($configKey, $default = null)
    {
        if (isset($this->configs[$configKey])) {
            $default = $this->configs[$configKey];
        }
        return $default;
    }
} 