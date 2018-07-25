<?php
namespace CMS\Infrastructure\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use CMS\Infrastructure\Common\AbstractClass;

class BaseEntity extends AbstractClass
{
    /** @ODM\Id */
    public $Id;

    /** @ODM\Version @ODM\Field(type="int") */
    public $Version;
}