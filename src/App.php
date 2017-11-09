<?php

namespace pxgamer\DirSync;

/**
 * Class App
 */
class App
{
    /**
     * @var string
     */
    private $hash;
    /**
     * @var string
     */
    private $receiverUrl;
    /**
     * @var string
     */
    private $clientName;
    /**
     * @var string
     */
    private $serverName;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->hash = getenv('DIRSYNC_HASH') ?? null;
        $this->receiverUrl = getenv('DIRSYNC_URL') ?? null;
        $this->clientName = getenv('DIRSYNC_CLIENT_NAME') ?? null;
        $this->serverName = getenv('DIRSYNC_SERVER_NAME') ?? null;
    }

    /**
     * @param $content
     * @return string
     */
    public static function json($content)
    {
        header('Content-Type: application/json, text/json, text/plain');
        return json_encode($content);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getReceiverUrl()
    {
        return $this->receiverUrl;
    }

    /**
     * @param string $receiverUrl
     */
    public function setReceiverUrl(string $receiverUrl)
    {
        $this->receiverUrl = $receiverUrl;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     */
    public function setClientName(string $clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * @param string $serverName
     */
    public function setServerName(string $serverName)
    {
        $this->serverName = $serverName;
    }
}
