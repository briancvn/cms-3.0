<?php

namespace CMS\Infrastructure\Extension\Mvc;

/**
 * CMS\Infrastructure\Extension\Mvc\Plugin
 * This class allows to access services in the services container by just only accessing a public property
 * with the same name of a registered service
 *
 * @property \CMS\Infrastructure\Extension\Api $application
 * @property \CMS\Infrastructure\Extension\Http\Request $request
 * @property \CMS\Infrastructure\Extension\Http\Response $response
 * @property \CMS\Infrastructure\Extension\Auth\Manager $authManager
 * @property \CMS\Infrastructure\Extension\Auth\TokenParserInterface $tokenParser
 * @property \CMS\Infrastructure\Service\UserService $userService
  */
class Plugin extends \Phalcon\Mvc\User\Plugin {}