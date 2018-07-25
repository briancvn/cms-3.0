<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Contract\ProfileDto;
use CMS\Infrastructure\Common\AbstractClass;

class AuthenticateDto extends AbstractClass
{
    public $Token;
    public $Expires;
    public $RoleGroups;

    /** @var ProfileDto */
    public $Profile;
}