<?php

namespace pxgamer\DirSync;

class Receiver
{
    private $response = [];
    private $rootPath;

    public function __construct($provided_hash = "", $movie_list, $tv_list, $sender)
    {
        $this->rootPath = realpath('..');

        $this->sender = ($sender !== '') ? $sender : "Unknown";
        if (App::HASH === $provided_hash) {
            (count($movie_list) > 0) ? $this->regMovies($movie_list) : null;
            (count($tv_list) > 0) ? $this->regTv($tv_list) : null;
            $this->response['Status'] = "Success";
            $this->response['Sender'] = App::SERVER_NAME;
            echo json_encode((object)$this->response);
        } else {
            $this->response['Status'] = "Unauthorised";
            echo json_encode((object)["Status" => "Unauthorised"]);
        }
    }

    private function regMovies($movie_list)
    {
        if (!$this->checkLength($movie_list)) {
            return false;
        }
        $this->writeToFile($movie_list, $this->rootPath . '/Server/Files/Movies.txt');
        return true;
    }

    private function regTv($tv_list)
    {
        if (!$this->checkLength($tv_list)) {
            return false;
        }
        $this->writeToFile($tv_list, $this->rootPath . '/Server/Files/TV.txt');
        return true;
    }

    private function checkLength($arr = [])
    {
        return (count($arr)) ? true : false;
    }

    private function writeToFile($data = [], $fileName = "null.txt")
    {
        $handle = fopen($fileName, "w+");
        if (!$handle) {
            $this->response[$fileName] = "Failed to open $fileName</br>";
            return false;
        }
        $this->response[$fileName] = "Successfully set file.";
        fwrite($handle, "<b class=\"sender\">Last Updated by: " . $this->sender . "</b>" . PHP_EOL);
        foreach ($data as $value) {
            fwrite($handle, $value . PHP_EOL);
        }
        return true;
    }
}