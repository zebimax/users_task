<?php
namespace Globals\Classes\Exceptions;
class AppException extends \Exception
{
    protected $messageTpl = '';
    public function __construct($tplValue)
    {
        parent::__construct(sprintf($this->messageTpl, $tplValue));
    }
} 