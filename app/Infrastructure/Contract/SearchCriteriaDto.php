<?php
namespace CMS\Infrastructure\Contract;

use CMS\Infrastructure\Common\AbstractClass;

class SearchCriteriaDto extends AbstractClass
{
    public $Skip;
    public $Limit;

    /** @var SortDto */
    public $Sort;

    /** @var FilterDto */
    public $Filter;
}