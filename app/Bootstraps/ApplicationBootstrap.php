<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;
use CMS\Infrastructure\Extension\Auth\TokenParsers\JWTTokenParser;
use CMS\Infrastructure\Extension\Auth\Manager as AuthManager;
use CMS\Infrastructure\Extension\Cache\Manager as CacheManager;
use CMS\Infrastructure\Domain\MappingProfile;
use CMS\Infrastructure\Constant\Services;

class ApplicationBootstrap implements BootstrapInterface
{
    public function run(Api $api, \Phalcon\DiInterface $di, \Phalcon\Config $config)
    {
        $di->setShared(Services::CONFIG, $config);

        $di->set(Services::DOCUMENT_MANAGER, function () use ($config) {
            $config = $config->get('database')->mongo;

            $configuration = new \Doctrine\ODM\MongoDB\Configuration();
            $configuration->setProxyDir(MODULE_DIR.'/Cache/Doctrine/Proxy');
            $configuration->setProxyNamespace('Proxies');
            $configuration->setHydratorDir(MODULE_DIR.'/Cache/Doctrine/Hydrator');
            $configuration->setHydratorNamespace('Hydrators');
            $configuration->setDefaultDB($config->dbname);
            $configuration->setMetadataDriverImpl(\Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create([DOMAIN_DIR, REPOSITORY_DIR]));

            $mongoClient = new \MongoClient($config->server);
            $connection = new \Doctrine\MongoDB\Connection($mongoClient);
            return \Doctrine\ODM\MongoDB\DocumentManager::create($connection, $configuration);
        });

        $di->set(Services::URL, function () use ($config) {
            $url = new \Phalcon\Mvc\Url;
            $url->setBaseUri($config->get('application')->baseUri);
            return $url;
        });

        $di->setShared(Services::EVENTS_MANAGER, function () {
            return new \Phalcon\Events\Manager;
        });

        $di->setShared(MapperManager::class, function () {
            return MapperManager::initialize(function (\AutoMapperPlus\Configuration\AutoMapperConfig $config, MapperManager $mapper) {
                MappingProfile::mappingConfig($config, $mapper);
            });
        });

        $di->setShared(Services::TOKEN_PARSER, function () use ($di, $config) {
            return new JWTTokenParser($config->get('authentication')->secret, JWTTokenParser::ALGORITHM_HS256);
        });

        $di->setShared(AuthManager::class, function () use ($di, $config) {
            $sessionAdapter = $di->get(Services::SESSION);
            $session = unserialize($sessionAdapter->get(Services::AUTH_MANAGER));
            return new AuthManager(
                $di->get(CacheManager::class),
                $config->get('authentication')->expirationTime,
                $session ? $session : null
            );
        });

        $di->setShared(CacheManager::class, function () {
            return new CacheManager;
        });

        $di->setShared(Services::SESSION, function () {
            $session = new \Phalcon\Session\Adapter\Files();
            $session->start();

            return $session;
        });
    }
}
