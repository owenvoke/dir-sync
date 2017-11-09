<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Receiver;

require '../../vendor/autoload.php';

$receiver = new Receiver();

$hash = isset($_POST['hash']) ? $_POST['hash'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : [];
if ($receiver->verify($hash)) {
    echo App::json($receiver->register($content));
} else {
    echo App::json((object)["status" => "unauthorised"]);
}
