<?php
/**
 * Created by PhpStorm.
 * User: rcordova
 * Date: 6/08/2019
 * Time: 14:38
 */

return [

    'default' => 'dte',
    'migrations' => 'migrations',
    'connections' => [
        'dte' => [
            'driver'    => 'pgsql',
            'host'      => env('DB1_HOST'),
            'port'      => env('DB1_PORT'),
            'database'  => env('DB1_DATABASE'),
            'username'  => env('DB1_USERNAME'),
            'password'  => env('DB1_PASSWORD'),
            'charset'   => 'utf8',
            'prefix'    => '',
            'strict'    => false,
        ],

    ],
];
