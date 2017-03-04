<?php

require '../../vendor/autoload.php';

$Client = new pxgamer\DirSync\Client;
$Client->init();
$Client->send();