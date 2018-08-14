<?php

try {
    preg_match('/^\/(\w+)(\/.*).html$/', $_REQUEST['_url'],$matches);
    $module = $matches[1];
    $viewPath = $matches[2];
    $moduleNamespace = 'CMS\\'.$module;

    define("ROOT_DIR", __DIR__.'/../..');
    define("VENDOR_DIR", ROOT_DIR.'/vendor');
    define("APP_DIR", ROOT_DIR.'/app');
    define("MODULE_DIR", ROOT_DIR.'/app/'.$module);

    $autoLoader = require_once VENDOR_DIR.'/autoload.php';
    Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$autoLoader, 'loadClass']);

    $loader = new \Phalcon\Loader();
    $loader->registerNamespaces(['CMS' => APP_DIR.'/'])
        ->registerClasses([$moduleNamespace.'\\Controller\\TemplateController' => MODULE_DIR.'/Controller/TemplateController.php'])
        ->register();

    $di = new \Phalcon\Di\FactoryDefault();
    $di->set('view', function() use ($di, $viewPath) {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir(MODULE_DIR.'/View');
        $view->registerEngines(array(
            '.phtml' => function($view, $di) {
                $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                $volt->setOptions(array(
                    'compiledPath'  => MODULE_DIR.'/Cache/',
                    'stat'          => true,
                    'compileAlways' => true
                ));
                $compiler = $volt->getCompiler();
                $compiler->addFunction('tag', function ($tag) {
                    return $tag.'->render()';
                });
                return $volt;
            }
        ));
        $view->disableLevel([
            \Phalcon\Mvc\View::LEVEL_LAYOUT      => true,
            \Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT => true,
        ]);
        $view->pick($viewPath);
        return $view;
    });

    $di->setShared('form', function () {
        return new CMS\Infrastructure\Extension\Templating\Control\Form();
    });
    $di->setShared('indicator', function () {
        return new CMS\Infrastructure\Extension\Templating\Control\Indicator();
    });

    $di->setShared('router', function () use ($module, $moduleNamespace) {
        $router = new \Phalcon\Mvc\Router(false);
        $router->setDefaults([
            'controller' => "template",
            'namespace'  => $moduleNamespace.'\\Controller',
            "action"     => "index"
        ]);
        return $router;
    });

    $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
