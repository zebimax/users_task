<?php

namespace Models;

use Globals\Classes\App\Db\AbstractModel;
use Globals\Classes\Exceptions\Db\EntityNotFoundException;

class Users extends AbstractModel
{
    protected $tableName = 'users';
    protected $joinedModels = [
        'info' => ['id'=> 'user_id']
    ];
    public function getAuthUser($login, $password)
    {
        return $this->getBy([
            'login' => $login,
            'password' => sprintf('MD5(CONCAT(%s, %s))', $password, $login)
        ]);
    }

    public function getUserInfo($id)
    {
        $user = $this->get($id);
        if (empty($user)) {
            throw new EntityNotFoundException('users');
        }

        $userInfo = $this->db->getModel('info')->getBy(['user_id' => $id]);
        if (empty($userInfo)) {
            throw new EntityNotFoundException('info');
        }

        $locale = $this->db->getModel('locales')->get($userInfo['locale_id']);
        unset($locale['id']);
        if (empty($locale)) {
            throw new EntityNotFoundException('locales');
        }
        return array_merge($user, $userInfo, $locale);
    }
}