<?php

namespace CMS\Infrastructure\Extension\Exception;

class Exception extends \Exception
{
    public function __construct($code, $message = null)
    {
        parent::__construct($message, $code);
    }
}
