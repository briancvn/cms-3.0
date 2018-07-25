<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Common\AbstractClass;
use CMS\Infrastructure\Constant\CommonConstants;

class ResourceRequestDto extends AbstractClass
{
    public $Language = CommonConstants::DEFAULT_LANGUAGE;
    public $Resources = array();
}