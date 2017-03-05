<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Receiver;

require '../../vendor/autoload.php';

$Receiver = new Receiver;

$hash = isset($_POST['hash']) ? $_POST['hash'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : [];
if ($Receiver->verify($hash)) {
    echo App::json($Receiver->register($content));
} else {
    echo App::json((object)["status" => "unauthorised"]);
}