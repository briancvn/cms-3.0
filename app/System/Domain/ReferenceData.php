<?php
namespace CMS\System\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(repositoryClass="CMS\System\Repository\ReferenceDataRepository") */
class ReferenceData extends BaseEntity
{
    /** @ODM\Field(type="string") */
    public $Kind;

    /** @ODM\Field(type="collection") */
    public $ReferenceDataValues;
}