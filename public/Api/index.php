<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

/** @var \Phalcon\Config $config */
$config = null;

/** @var \PhalconRest\Api $app */
$app = null;

/** @var \PhalconApi\Http\Response $response */
$response = null;

session_start();
try {
    preg_match('/^\/(\w+)\/.*/', $_REQUEST['_url'],$matches);
    $module = $matches[1];
    $moduleNamespace = 'CMS\\'.$module;

    define("ROOT_DIR", __DIR__.'/../..');
    define("APP_DIR", ROOT_DIR.'/app');
    define("MODULE_DIR", ROOT_DIR.'/app/'.$module);
    define("VENDOR_DIR", ROOT_DIR.'/vendor');
    define("INFRASTRUCTURE_DIR", APP_DIR.'/Infrastructure');
    define("INFRASTRUCTURE_RESOURCE_DIR", INFRASTRUCTURE_DIR.'/Resource');

    define("CONFIG_DIR", MODULE_DIR.'/Config');
    define("CACHE_DIR", MODULE_DIR.'/Cache/');
    define("CONTRACT_DIR", MODULE_DIR.'/Contract');
    define("DOMAIN_DIR", MODULE_DIR.'/Domain');
    define("SERVICE_DIR", MODULE_DIR.'/Service');
    define("REPOSITORY_DIR", MODULE_DIR.'/Repository');
    define("RESOURCE_DIR", MODULE_DIR.'/Resource');
    define("CONTROLLER_DIR", MODULE_DIR.'/Controller');

    define("MODULE", $module);
    define("CONTROLLER_NAMESPACE", $moduleNamespace.'\Controller');
    define("DOMAIN_NAMESPACE", $moduleNamespace.'\Domain');
    define("SERVICE_NAMESPACE", $moduleNamespace.'\Service');
    define("CONTRACT_NAMESPACE", $moduleNamespace.'\Contract');

    define("ACCESS_DINIFITIONS_PATH", MODULE_DIR.'/AccessControlDefinitions.xml');
    define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

    $autoLoader = require_once VENDOR_DIR.'/autoload.php';
    Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$autoLoader, 'loadClass']);

    $loader = new \Phalcon\Loader();
    $loader->registerNamespaces(['CMS' => APP_DIR.'/'])
        ->register();

    $configPath = APP_DIR.'/Config/default.php';
    if (!is_readable($configPath)) {
        throw new Exception('Unable to read config from '.$configPath);
    }
    $config = new Phalcon\Config(include_once $configPath);

    $envConfigPath = CONFIG_DIR.'/server.'.APPLICATION_ENV.'.php';

    if (!is_readable($envConfigPath)) {
        throw new Exception('Unable to read config from '.$envConfigPath);
    }

    $override = new Phalcon\Config(include_once $envConfigPath);
    $config = $config->merge($override);

    $di = new CMS\Infrastructure\Extension\FactoryDefault();
    $app = new CMS\Infrastructure\Extension\Api($di);

    $bootstrap = new CMS\Bootstrap(
        new CMS\Bootstraps\ApplicationBootstrap,
        new CMS\Bootstraps\MiddlewareBootstrap,
        new CMS\Bootstraps\RepositoryBootstrap,
        new CMS\Bootstraps\ServiceBootstrap,
        new CMS\Bootstraps\ControllerBootstrap,
        new CMS\Bootstraps\RouterBootstrap
    );
    $bootstrap->run($di, $config, $app);

    $app->handle();

    // Set appropriate response value
    $response = $app->di->getShared(CMS\Infrastructure\Constant\Services::RESPONSE);
    $response->setJsonContent(new CMS\Infrastructure\Contract\ResponseDto([Result => $app->getReturnedValue()]));
} catch (\Exception $e) {
    $di = $di ?? new CMS\Infrastructure\Extension\FactoryDefault();
    $response = $di->getShared(CMS\Infrastructure\Constant\Services::RESPONSE);
    if(!$response || !$response instanceof CMS\Infrastructure\Extension\Http\Response){
        $response = new CMS\Infrastructure\Extension\Http\Response();
    }
    $debugMode = isset($config->debug) ? $config->debug : (APPLICATION_ENV == 'development');
    $response->setErrorContent($e, $debugMode);
}
finally {
    // Send response
    if (!$response->isSent()) {
        $response->send();
    }
}
