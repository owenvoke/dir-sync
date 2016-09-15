<?php

class PlexCronReceiver {
	
	private $serverName     = "PlexCronServer";
	private $moviesTextPath = "./Files/Movies.txt";
	private $tvTextPath     = "./Files/TV.txt";
	private $hash           = "a75f22d3cd5aea";
	
	private $response = [];
	
	function __construct ($provided_hash = "", $movie_list, $tv_list, $sender) {
		
		$this->sender = ($sender !== '') ? $sender : "Unknown";
		if ($this->hash === $provided_hash) {
			(count($movie_list) > 0) ? $this->reg_movies($movie_list) : null;
			(count($tv_list) > 0) ? $this->reg_tv($tv_list) : null;
			$this->response['Status'] = "Success";
			$this->response['Sender'] = $this->serverName;
			echo json_encode((object)$this->response);
		}
		else {
			$this->response['Status'] = "Unauthorised";
			echo json_encode((object)["Status" => "Unauthorised"]);
		}
		
	}
	
	private function reg_movies ($movie_list) {
		
		if (!$this->checkLength($movie_list)) { return false; }
		$this->writeToFile($movie_list, $this->moviesTextPath);
		return true;
		
	}
	
	private function reg_tv ($tv_list) {
		
		if (!$this->checkLength($tv_list)) { return false; }
		$this->writeToFile($tv_list, $this->tvTextPath);
		return true;
		
	}
	
	private function checkLength ($arr = []) {
		
		return (count($arr)) ? true : false;
		
	}
	
	private function writeToFile ($data = [], $fileName = "null.txt") {
		
		$handle = fopen($fileName, "w+");
		if (!$handle) { $this->response[$fileName] = "Failed to open $fileName</br>"; return false; }
		$this->response[$fileName] = "Successfully set file.";
		fwrite($handle, "<b class=\"sender\">Last Updated by: " . $this->sender . "</b>" . PHP_EOL);
		foreach($data as $value){
			fwrite($handle, $value . PHP_EOL);
		}
		return true;
		
	}
	
}

header('Content-Type: text/json');
if (isset($_POST['hash']) && $_POST['hash'] !== '') {
	$movies = (isset($_POST['movies']) && $_POST['movies']) ? $_POST['movies'] : [];
	$tv_shows = (isset($_POST['tv_shows']) && $_POST['tv_shows']) ? $_POST['tv_shows'] : [];
	$PCR = new PlexCronReceiver($_POST['hash'], $movies, $tv_shows, $_POST['sender']);
}
else {
	echo json_encode((object)["Status" => "Unauthorised"]);
}