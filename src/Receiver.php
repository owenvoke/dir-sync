<?php

namespace pxgamer\DirSync;

class Receiver
{
    private $rootPath;
    private $verified = false;

    public function __construct()
    {
        $this->rootPath = realpath('..');
    }

    public function verify($senderHash)
    {
        if (App::HASH === $senderHash) {
            $this->verified = true;
        }

        return $this->verified;
    }

    public function register($array)
    {
        if (!count($array)) {
            return ['status' => 'no content'];
        }
        foreach ($array as $key => $item) {
            $this->writeToFile($item, $this->rootPath . '/Server/Files/' . $key);
        }
        return ['status' => 'success'];
    }

    private function writeToFile($data = [], $fileName = "null")
    {
        $handle = fopen($fileName . '.txt', "w+");
        if (!$handle) {
            return false;
        }
        $json = (object)[
            'last_updated_by' => App::CLIENT_NAME,
            'last_updated_on' => time(),
            'content' => $data
        ];
        fwrite($handle, json_encode($json));
        return true;
    }
}