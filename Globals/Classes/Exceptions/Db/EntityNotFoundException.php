<?php

namespace Globals\Classes\Exceptions\Db;

use Globals\Classes\Exceptions\AppException;

class EntityNotFoundException extends AppException
{
    protected $messageTpl = 'Entity not found in %s';
}