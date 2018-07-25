<?php
namespace CMS\Infrastructure\Contract;

class UserSearchResultDto extends BaseDto
{
    public $Username;
    public $Email;
    public $Phone;
    public $Pin;
    public $RoleGroups;
}
