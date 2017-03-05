<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Client;

require '../../vendor/autoload.php';

$Client = new Client;
$Client->init(
    [
        'Films' => 'C:\Users\PXgamer\Films',
        'TV Shows' => 'C:\Users\PXgamer\TV Shows'
    ]
);
echo App::json($Client->send());