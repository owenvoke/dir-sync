<?php

namespace pxgamer\DirSync;

use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    const TEST_HASH = 'random-hash-for-dir-sync';
    const TEST_URL = 'fake-url-for-dir-sync';
    const TEST_CLIENT_NAME = 'DirSyncTestClient';
    const TEST_SERVER_NAME = 'DirSyncTestServer';

    public function testCanAppendVariablesFromEnvironment()
    {
        $app = new App();

        $this->assertTrue($app->getHash() === getenv('DIRSYNC_HASH'));
        $this->assertTrue($app->getReceiverUrl() === getenv('DIRSYNC_URL'));
        $this->assertTrue($app->getClientName() === getenv('DIRSYNC_CLIENT_NAME'));
        $this->assertTrue($app->getServerName() === getenv('DIRSYNC_SERVER_NAME'));
    }

    public function testCanSetHash()
    {
        $app = new App();
        $app->setHash(self::TEST_HASH);

        $this->assertTrue($app->getHash() === self::TEST_HASH);
    }

    public function testCanSetUrl()
    {
        $app = new App();
        $app->setReceiverUrl(self::TEST_URL);

        $this->assertTrue($app->getReceiverUrl() === self::TEST_URL);
    }

    public function testCanSetClientName()
    {
        $app = new App();
        $app->setClientName(self::TEST_CLIENT_NAME);

        $this->assertTrue($app->getClientName() === self::TEST_CLIENT_NAME);
    }

    public function testCanSetServerName()
    {
        $app = new App();
        $app->setServerName(self::TEST_SERVER_NAME);

        $this->assertTrue($app->getServerName() === self::TEST_SERVER_NAME);
    }
}
