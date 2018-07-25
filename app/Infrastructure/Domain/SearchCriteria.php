<?php
namespace CMS\Infrastructure\Domain;

use CMS\Infrastructure\Common\AbstractClass;

class SearchCriteria extends AbstractClass
{
    public $Skip;
    public $Limit;

    /** @var Sort */
    public $Sort;

    /** @var Filter */
    public $Filter;
}