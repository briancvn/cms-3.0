<?php

namespace CMS\Infrastructure\Extension\Templating;

class TagBuilder extends \Comsolit\HTMLBuilder\HTMLBuilder
{
    public function MergeAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->addAttribute($key, $value);
        }
    }
}
