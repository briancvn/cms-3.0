<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Common\AbstractClass;

class AuthRequestDto extends AbstractClass
{
    public $Username;
    public $Password;
}