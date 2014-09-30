<?php

namespace Globals\Classes\Exceptions;

class NotLocaleException extends AppException
{
    protected $messageTpl = 'Locale not found %s';
}