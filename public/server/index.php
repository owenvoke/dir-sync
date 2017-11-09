<?php

use pxgamer\DirSync\App;
use pxgamer\DirSync\Receiver;

require '../../vendor/autoload.php';

if (file_exists(__DIR__.'/../../.env')) {
    $dotEnv = new Dotenv\Dotenv(__DIR__.'/../../');
    $dotEnv->load();
}

$app = new App();

$receiver = new Receiver($app);

$hash = isset($_POST['hash']) ? $_POST['hash'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : [];
if ($receiver->verify($hash)) {
    echo App::json($receiver->register($content));
} else {
    echo App::json((object)["status" => "unauthorised"]);
}
