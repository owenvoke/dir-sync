<?php

namespace pxgamer\DirSync;

/**
 * Class Receiver
 */
class Receiver
{
    /**
     * @var App
     */
    private $app;
    /**
     * @var bool|string
     */
    private $rootPath;
    /**
     * @var bool
     */
    private $verified = false;

    /**
     * Receiver constructor.
     */
    public function __construct()
    {
        $this->rootPath = realpath('..');
    }

    /**
     * @param $senderHash
     * @return bool
     */
    public function verify($senderHash)
    {
        if ($this->app->getHash() === $senderHash) {
            $this->verified = true;
        }

        return $this->verified;
    }

    /**
     * @param $array
     * @return array
     */
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

    /**
     * @param array  $data
     * @param string $fileName
     * @return bool
     */
    private function writeToFile($data = [], $fileName = "null")
    {
        $handle = fopen($fileName . '.txt', "w+");
        if (!$handle) {
            return false;
        }
        $json = (object)[
            'last_updated_by' => $this->app->getClientName(),
            'last_updated_on' => time(),
            'content'         => $data
        ];
        fwrite($handle, json_encode($json));
        return true;
    }
}
