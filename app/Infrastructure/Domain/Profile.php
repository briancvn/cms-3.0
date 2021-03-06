<?php
namespace CMS\Infrastructure\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(repositoryClass="CMS\Repository\ProfileRepository") */
class Profile extends BaseEntity
{
    /** @ODM\Field(type="int") */
    public $Pin;

    /** @ODM\Field(type="string") */
    public $FirstName;

    /** @ODM\Field(type="string") */
    public $LastName;

    /** @ODM\Field(type="date") */
    public $Birthday;

    /** @ODM\Field(type="string") */
    public $Gender;

    /** @ODM\Field(type="string") */
    public $Language;
}