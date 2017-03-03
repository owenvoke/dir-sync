<?php

namespace pxgamer\PlexCron;

class Client
{
    public $movies = [];
    public $tv_shows = [];
    private $debug = false;
    private $server = "";

    public function __construct($server = "", $scanMovies = true, $scanTv = true, $debug = false)
    {
        $this->server = ($server) ? $server : false;
        $this->debug = ($debug) ? true : false;

        ($scanMovies) ? $this->scanMovies() : null;
        ($scanTv) ? $this->scanTv() : null;
        $this->send();
    }


    public function scanMovies()
    {
        $this->movies = $this->recurseFolder('movies');
        ($this->debug) ? var_dump($this->movies) : null;
    }

    public function scanTv()
    {
        $this->tv_shows = $this->recurseFolder('tv');
        ($this->debug) ? var_dump($this->tv_shows) : null;
    }

    public function send()
    {
        header('Content-Type: text/json');
        $sendObject = (object)[
            "hash" => $this->hash,
            "movies" => $this->movies,
            "tv_shows" => $this->tv_shows,
            "sender" => $this->sender
        ];
        if ($this->debug) {
            echo json_encode($sendObject);
        } else {
            $ch = curl_init();
            CURL_SETOPT_ARRAY(
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

    private function recurseFolder($type = false)
    {
        $folders = [];
        if ($type) {
            switch ($type) {
                case 'movies':
                    $path = $this->moviesPath;
                    if (is_dir($path)) {
                        $results = scandir($path);

                        foreach ($results as $result) {
                            if ($result === '.' || $result === '..') {
                                continue;
                            }

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
                            if ($result === '.' || $result === '..') {
                                continue;
                            }

                            if (is_dir($path . '\\' . $result)) {
                                $subPath = scandir($path . '\\' . $result);
                                foreach ($subPath as $series) {
                                    if ($series === '.' || $series === '..') {
                                        continue;
                                    }
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
}
