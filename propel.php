<?php

return [
    'propel' => [
        'paths' => [
            // The directory where Propel expects to find your `schema.xml` file.
            'schemaDir' => '/Applications/XAMPP/xamppfiles/htdocs/pixelart',

            // The directory where Propel should output generated object model classes.
            'phpDir' => '/Applications/XAMPP/xamppfiles/htdocs/pixelart/src',
        ],
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=127.0.0.1;port=8889;dbname=pixelart',
                    'user' => 'root',
                    'password' => 'root',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ]
    ]
];
