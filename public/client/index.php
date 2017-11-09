<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Client;

require '../../vendor/autoload.php';

if (file_exists(__DIR__.'/../../.env')) {
    $dotEnv = new Dotenv\Dotenv(__DIR__.'/../../');
    $dotEnv->load();
}

$app = new App();

$client = new Client($app);

$client->init(
    [
        'Films'    => 'C:\Users\PXgamer\Films',
        'TV Shows' => 'C:\Users\PXgamer\TV Shows'
    ]
);

echo App::json($client->send());
