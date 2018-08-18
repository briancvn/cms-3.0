<?php
/**
 * Read more on Configs Files
 * @link http://phalcon-rest.redound.org/config_files.html
 */

return [
    'application' => [
        'title' => 'CMS',
        'description' => 'Centralized Management Solutions',
        'baseUri' => '/cms'
    ],
    'authentication' => [
        'secret' => 'Centralized_Management_Solutions',
        'expirationTime' => 86400 * 7 // One week
    ],
    'externals' => [
        'client' => [
            'reCaptchaSiteKey' => '6LcpvCAUAAAAAAO_NvOBvrfHv-DrzvP01wroWQOi'
        ],
        'server' => []
    ]
];
