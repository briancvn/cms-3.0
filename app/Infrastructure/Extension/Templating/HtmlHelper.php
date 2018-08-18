<?php
namespace CMS\Infrastructure\Extension\Templating;

class HtmlHelper
{
    /** @var \Phalcon\DiInterface */
    private $di;

    public function __construct(\Phalcon\DiInterface $di) {
        $this->di = $di;
    }

    public function partial($viewPath) {
        return $this->di->getView()->getPartial($viewPath);
    }
}