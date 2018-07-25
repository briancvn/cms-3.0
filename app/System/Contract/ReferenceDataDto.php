<?php
namespace CMS\System\Contract;

use CMS\Infrastructure\Contract\BaseDto;

class ReferenceDataDto extends BaseDto
{
    public $Kind;
    public $ReferenceDataValues = array();
}