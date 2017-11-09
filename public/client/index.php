<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Client;

require '../../vendor/autoload.php';

$client = new Client();
$client->init(
    [
        'Films'    => 'C:\Users\PXgamer\Films',
        'TV Shows' => 'C:\Users\PXgamer\TV Shows'
    ]
);

echo App::json($client->send());
