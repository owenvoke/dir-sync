<?php

require '../vendor/autoload.php';

$PC = new pxgamer\PlexCron\Client(
    "",    // Plex Server receiver (must be a web URL)
    true,                                               // Choose whether the Movies folder will be scanned
    true,                                               // Choose whether the TV Shows folder will be scanned
    false                                               // Choose whether debugging is on
);
