<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

/** @var \PhalconRest\Api $app */
$app = null;

session_start();
try {
    preg_match('/^\/(\w+)(\/.*).html$/', $_REQUEST['_url'],$matches);
    $module = $matches[1];
    $viewPath = $matches[2];
    $moduleNamespace = 'CMS\\'.$module;

    define('ROOT_DIR', __DIR__.'/../..');
    define('VENDOR_DIR', ROOT_DIR.'/vendor');
    define('APP_DIR', ROOT_DIR.'/app');
    define('MODULE_DIR', ROOT_DIR.'/app/'.$module);
    define('VIEW_DIR', MODULE_DIR.'/View');
    define('CACHE_DIR', MODULE_DIR.'/Cache/');

    define('VIEW_PATH', $viewPath);
    define('MODULE_NAME', $moduleNamespace);

    $autoLoader = require_once VENDOR_DIR.'/autoload.php';
    Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$autoLoader, 'loadClass']);

    $loader = new \Phalcon\Loader();
    $loader->registerNamespaces(['CMS' => APP_DIR.'/'])
        ->registerClasses([$moduleNamespace.'\\Controller\\TemplateController' => MODULE_DIR.'/Controller/TemplateController.php'])
        ->register();

    $configPath = APP_DIR.'/Config/default.php';
    if (!is_readable($configPath)) {
        throw new Exception('Unable to read config from '.$configPath);
    }

    $config = new Phalcon\Config(include_once $configPath);
    $di = new \Phalcon\Di\FactoryDefault();
    $app = new \Phalcon\Mvc\Application($di);

    $bootstrap = new CMS\Bootstrap(
        new CMS\Bootstraps\TemplateBootstrap,
        new CMS\Bootstraps\ControlBootstrap
    );
    $bootstrap->run($di, $config);

    echo $app->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
