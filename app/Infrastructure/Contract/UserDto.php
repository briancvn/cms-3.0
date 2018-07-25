<?php
namespace CMS\Infrastructure\Contract;

class UserDto extends BaseDto
{
    public $Username;
    public $Email;
    public $Phone;
    public $Pin;
    public $RoleGroups;
    public $Profile;
}