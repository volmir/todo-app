<?php

return [
    'appName' => 'ToDo application',
    'version' => '0.0.1',
    'routes' => [
        '/robots.txt' => 'site/robots',        
        '/sitemap.xml' => 'site/sitemap',         
    ],    
    'db' => [
        'dbname' => 'test',
        'user' => 'root',
        'password' => '',
        'host' => '127.0.0.1',
        'driver' => 'pdo_mysql',
    ]
];
