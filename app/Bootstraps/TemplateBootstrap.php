<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;

class TemplateBootstrap implements BootstrapInterface
{
    public function run(\Phalcon\DiInterface $di, \Phalcon\Config $config, Api $api = null)
    {
        $di->set('view', function() use ($di) {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir(VIEW_DIR);
            $view->registerEngines(array(
                '.phtml' => function($view, $di) {
                    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                    $volt->setOptions(array(
                        'compiledPath'  => CACHE_DIR,
                        'stat'          => true,
                        'compileAlways' => true
                    ));
                    $compiler = $volt->getCompiler();
                    $compiler->addFunction('tag', function ($tag) {
                        return $tag.'->render()';
                    });
//                    $compiler->addFunction('partial', function ($viewPath) use($compiler) {
//                        return sprintf('"%s"', $compiler->compile(VIEW_DIR.'/'.str_replace('\'', '', $viewPath).'.phtml'));
//                    });
                    return $volt;
                }
            ));
            $view->disableLevel([
                \Phalcon\Mvc\View::LEVEL_LAYOUT      => true,
                \Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT => true,
            ]);
            $view->pick(VIEW_PATH);
            return $view;
        });

        $di->setShared('router', function () {
            $router = new \Phalcon\Mvc\Router(false);
            $router->setDefaults([
                'controller' => "template",
                'namespace'  => MODULE_NAME.'\\Controller',
                "action"     => "index"
            ]);
            return $router;
        });

        $di->set('url', function() use ($config) {
            $config = $config->get('application');
            $url = new \Phalcon\Mvc\Url();
            $url->setBaseUri($config->baseUri);
            return $url;
        });
    }
}
