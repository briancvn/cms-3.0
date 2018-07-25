<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Common\AbstractClass;

class ResponseDto extends AbstractClass
{
    public $Result;

    /** @var ResponseErrorDto */
    public $Error;

    /** @var ResponseWarningDto */
    public $Warning;

    /** @var ResponseValidationDto */
    public $ValidationErrors = array();
}