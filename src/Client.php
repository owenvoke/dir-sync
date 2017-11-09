<?php

namespace pxgamer\DirSync;

/**
 * Class Client
 */
class Client
{
    /**
     * @var App
     */
    private $app;
    /**
     * @var array
     */
    public $to_send = [];

    /**
     * Client constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param array $directories
     * @return bool
     */
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

    /**
     * @return mixed
     */
    public function send()
    {
        $sendObject = (object)[
            "hash"    => $this->app->getHash(),
            "content" => $this->to_send,
            "sender"  => $this->app->getClientName(),
        ];

        $ch = curl_init();
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL            => $this->app->getReceiverUrl(),
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => http_build_query($sendObject),
                CURLOPT_RETURNTRANSFER => 1
            ]
        );
        return json_decode(curl_exec($ch));
    }

    /**
     * @param $folder_path
     * @return array
     */
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
