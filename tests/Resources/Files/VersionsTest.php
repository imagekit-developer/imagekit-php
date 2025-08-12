<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Versions\VersionDeleteParams;
use ImageKit\Files\Versions\VersionRestoreParams;
use ImageKit\Files\Versions\VersionRetrieveParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class VersionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            privateAPIKey: 'My Private API Key',
            password: 'My Password',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionRetrieveParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->retrieve('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionRetrieveParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->retrieve('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->versions->list('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionDeleteParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->delete('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionDeleteParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->delete('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRestore(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionRestoreParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->restore('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRestoreWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = VersionRestoreParams::new(fileID: 'fileId');
        $result = $this->client->files->versions->restore('versionId', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
