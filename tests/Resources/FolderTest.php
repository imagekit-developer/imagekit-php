<?php

namespace Tests\Resources;

use ImageKit\Client;
use ImageKit\Folder\FolderCreateParams;
use ImageKit\Folder\FolderDeleteParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class FolderTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderCreateParams::with(
            folderName: 'summer',
            parentFolderPath: '/product/images/'
        );
        $result = $this->client->folder->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderCreateParams::with(
            folderName: 'summer',
            parentFolderPath: '/product/images/'
        );
        $result = $this->client->folder->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderDeleteParams::with(folderPath: '/folder/to/delete/');
        $result = $this->client->folder->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderDeleteParams::with(folderPath: '/folder/to/delete/');
        $result = $this->client->folder->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
