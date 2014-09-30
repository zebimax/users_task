<?php
return [
    'routes' => [
        '' => ['module' => 'Users'],
        'auth'=> ['module' => 'Users'],
        'login' => ['module' => 'Users', 'action' => 'login'],
        'logout' => ['module' => 'Users', 'action' => 'logout'],
    ],
    'modules' => [
        'Users' => [
            'default' => 'auth'
        ]
    ],
    'db' => [
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'password' => '',
        'db_name' => 'test'
    ],
    'strict_locales' => false
];