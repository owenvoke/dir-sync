<?php

header('Content-Type: text/json');
if (isset($_POST['hash']) && $_POST['hash'] !== '') {
    $movies = (isset($_POST['movies']) && $_POST['movies']) ? $_POST['movies'] : [];
    $tv_shows = (isset($_POST['tv_shows']) && $_POST['tv_shows']) ? $_POST['tv_shows'] : [];

    $PCR = new \pxgamer\PlexCron\Receiver($_POST['hash'], $movies, $tv_shows, $_POST['sender']);
} else {
    echo json_encode((object)["Status" => "Unauthorised"]);
}
