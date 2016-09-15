<?php

class PlexCronClient {

	private $sender     = "PlexCronClient";  // PlexCron Client Name (to be sent to the server)
    private $moviesPath = "C:\\Movies";      // Scan Path for Movies
    private $tvPath     = "C:\\TV Shows";    // Scan Path for TV Shows
	private $hash       = "a75f22d3cd5aea";  // Create a random hash here (make sure it matches the Server hash)
	
    public $movies      = [];
    public $tv_shows    = [];
    private $debug      = false;
    private $server     = "";
	

    function __construct ($server = "", $scanMovies = true, $scanTv = true, $debug = false ) {
		
		$this->server = ($server) ? $server : false;
		$this->debug = ($debug) ? true : false;

        ($scanMovies) ? $this->scanMovies() : null;
        ($scanTv) ? $this->scanTv() : null;
		$this->plexCronSend();

    }


    public function scanMovies () {
		
        $this->movies   = $this->recurseFolder('movies');
		($this->debug) ? var_dump($this->movies) : null;
		
    }

    public function scanTv () {
		
		$this->tv_shows = $this->recurseFolder('tv');
		($this->debug) ? var_dump($this->tv_shows) : null;
		
    }
	
	private function recurseFolder ($type = false) {
		
		$folders = [];
		if ($type) {
			switch ($type) {
				case 'movies':
					$path = $this->moviesPath;
					if (is_dir($path)) {
						$results = scandir($path);

						foreach ($results as $result) {
							if ($result === '.' or $result === '..') continue;

							if (is_dir($path . '\\' . $result)) {
								$folders[] = $result;
							}
						}
					}
					break;
				case 'tv':
					$path = $this->tvPath;
					if (is_dir($path)) {
						$results = scandir($path);
						
						foreach ($results as $result) {
							if ($result === '.' or $result === '..') continue;

							if (is_dir($path . '\\' . $result)) {
								$subPath = scandir($path . '\\' . $result);
								foreach ($subPath as $series) {
									if ($series === '.' or $series === '..') continue;
									if (is_dir($path . '\\' . $result . '\\' . $series)) {
										$folders[] = $result . "/" . $series;
									}
								}
							}
						}
					}
					break;
				default:
					break;
			}
		}
		return $folders;
	}
	
	public function plexCronSend () {
		header('Content-Type: text/json');
		$sendObject = (object)[
			"hash" => $this->hash,
			"movies" => $this->movies,
			"tv_shows" => $this->tv_shows,
			"sender" => $this->sender
		];
		if ($this->debug) {
			echo json_encode($sendObject);
		}
		else {
			$ch = curl_init();
			CURL_SETOPT_ARRAY (
				$ch,
				[
					CURLOPT_URL => $this->server,
					CURLOPT_POST => 1,
					CURLOPT_SSL_VERIFYPEER => 0,
					CURLOPT_SSL_VERIFYHOST => 0,
					CURLOPT_POSTFIELDS => http_build_query($sendObject),
					CURLOPT_RETURNTRANSFER => 1
				]
			);
			echo curl_exec($ch);
		}
	}
}