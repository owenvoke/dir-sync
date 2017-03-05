<?php

namespace pxgamer\DirSync;

class App
{
    const RECEIVER_URL = "http://localhost/PlexCron/public/Server/";

    const CLIENT_NAME = "DirSyncClient";
    const SERVER_NAME = "DirSyncServer";

    const HASH = "a75f22d3cd5aea";

    public static function json($content)
    {
        header('Content-Type: application/json, text/json, text/plain');
        return json_encode($content);
    }
}