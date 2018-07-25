<?php

return [
    'debug' => true,
    'hostName' => 'dev.cms.com',
    'clientHostName' => 'localhost',
    'database' => [
        'mongo'  => [
            'server'     => 'mongodb://localhost:27017',
            'dbname'   => 'cms',
            'username' => '',
            'password' => ''
        ]
    ],
    'cors' => [
        'allowedOrigins' => ['*']
    ]
];
