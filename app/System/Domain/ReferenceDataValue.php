<?php
namespace CMS\System\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use CMS\Infrastructure\Common\AbstractClass;

/** @ODM\Document */
class ReferenceDataValue extends AbstractClass
{
    /** @ODM\Field(type="string") */
    public $Code;

    /** @ODM\Field(type="string") */
    public $Text;

    /** @ODM\Field(type="raw") */
    public $Properties;
}