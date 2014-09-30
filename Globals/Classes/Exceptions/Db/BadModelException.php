<?php

namespace Globals\Classes\Exceptions\Db;

use Globals\Classes\Exceptions\AppException;

class BadModelException extends AppException
{
    protected $messageTpl = 'Bad or not exists %s db model';
}