<?php

header('Content-Type: text/json');
if (isset($_POST['hash']) && $_POST['hash'] !== '') {
    $PCR = new \pxgamer\DirSync\Receiver($_POST['hash'], $movies, $tv_shows, $_POST['sender']);
} else {
    echo json_encode((object)["Status" => "Unauthorised"]);
}
