<?php

include ('./PlexCronClient.php');

$PC = new PlexCronClient(
	"http://localhost/PlexCron/PlexCronReceiver.php",	// Plex Server receiver (must be a web URL)
	true,                                               // Choose whether the Movies folder will be scanned
	true,                                               // Choose whether the TV Shows folder will be scanned
	false                                               // Choose whether debugging is on
);
