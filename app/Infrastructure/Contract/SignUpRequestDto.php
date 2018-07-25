<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Common\AbstractClass;

class SignUpRequestDto extends AbstractClass
{
    public $Username;
    public $Email;
    public $Phone;
    public $Password;

    /** @var ProfileDto */
    public $Profile;
}