<?php

namespace CMS\Infrastructure\Constant;

class CacheConstants
{
    const LIFE_TIME = 86400 * 7; // One week
    const ACCESS_CONTROL_CACHE_KEY = 'accessControlCacheKey';
    const CONTROLLER_CACHE_KEY = 'controllerCacheKey';
}