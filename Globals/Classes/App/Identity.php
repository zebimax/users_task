<?php

namespace Globals\Classes\App;


use Models\Users;

class Identity
{
    private $id;
    private $login;
    private $isAuth;

    /** @var Users */
    private $users;

    private $info;

    private $locale;

    public function __construct($id)
    {
        $this->id = $id;
        $this->isAuth = $this->id > 0;
        $db = \App::getApp()->getDb();
        $this->users = $db->getModel('users');
        $this->initIdentityData();
    }

    /**
     * @return mixed
     */
    public function getIsAuth()
    {
        return $this->isAuth;
    }

    public function auth()
    {

    }
    public function get()
    {
        
    }

    public function getLocale()
    {
        $locale = [
            'id' => false, 'lang' => false
        ];
        if (isset($this->info['locale_id']) && isset($this->info['lang'])) {
            $locale['id'] = $this->info['locale_id'];
            $locale['lang'] = $this->info['lang'];
        }
        return $locale;
    }

    public function getInfo()
    {
        return $this->info;
    }

    private function checkUser($login, $password)
    {

    }

    private function initIdentityData()
    {
        if ($this->isAuth) {
            $this->info = $this->users->getUserInfo($this->id);
        }
    }
} 