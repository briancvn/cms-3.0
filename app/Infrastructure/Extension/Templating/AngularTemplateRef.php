<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularTemplateRef
{
    /** @var string */
    public $key;

    /** @var string */
    public $type;

    /** @var string */
    public $templateKey;

    public function __construct(string $key, string $type = '') {
        $this->key = $key;
        $this->type = $type;
        if (!empty($key))
        {
            $this->templateKey = '#'.$key;
        }
    }

    public function isEmpty(): boolean
    {
        return empty($this->key);
    }
}
