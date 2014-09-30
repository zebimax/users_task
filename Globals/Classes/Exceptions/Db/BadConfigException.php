<?php
namespace Globals\Classes\Exceptions\Db;

use Globals\Classes\Exceptions\AppException;

class BadConfigException extends AppException
{
    protected $messageTpl = 'Bad or not exists %s configuration value for db connection';
}