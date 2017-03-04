<?php

namespace pxgamer\DirSync;

class Client
{
    public $to_send = [];

    public function init($directories = [])
    {
        if (empty($directories) || !is_array($directories)) {
            return false;
        }

        foreach ($directories as $key => $directory) {
            $this->to_send[$key] = $this->scan($directory);
        }
        return true;
    }

    public function send()
    {
        header('Content-Type: text/json');
        $sendObject = (object)[
            "hash" => App::HASH,
            "content" => $this->to_send,
            "sender" => App::CLIENT_NAME
        ];
        $ch = curl_init();
        CURL_SETOPT_ARRAY(
            $ch,
            [
                CURLOPT_URL => App::RECEIVER_URL,
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_POSTFIELDS => http_build_query($sendObject),
                CURLOPT_RETURNTRANSFER => 1
            ]
        );
        return curl_exec($ch);
    }

    private function scan($folder_path)
    {
        $folders = [];
        if (is_dir($folder_path)) {
            $results = new \DirectoryIterator($folder_path);

            foreach ($results as $result) {
                if ($result->isDot() || !$result->isDir()) {
                    continue;
                }

                $folders[] = $result->getBasename();
            }
        }
        return $folders;
    }
}
