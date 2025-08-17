<?php

namespace Tests\Resources;

use ImageKit\Client;
use ImageKit\Folders\FolderCopyParams;
use ImageKit\Folders\FolderCreateParams;
use ImageKit\Folders\FolderDeleteParams;
use ImageKit\Folders\FolderMoveParams;
use ImageKit\Folders\FolderRenameParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class FoldersTest extends TestCase
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
        $result = $this->client->folders->create($params);

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
        $result = $this->client->folders->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderDeleteParams::with(folderPath: '/folder/to/delete/');
        $result = $this->client->folders->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderDeleteParams::with(folderPath: '/folder/to/delete/');
        $result = $this->client->folders->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderCopyParams::with(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->folders->copy($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderCopyParams::with(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
            includeVersions: true,
        );
        $result = $this->client->folders->copy($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderMoveParams::with(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->folders->move($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderMoveParams::with(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->folders->move($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderRenameParams::with(
            folderPath: '/path/of/folder',
            newFolderName: 'new-folder-name'
        );
        $result = $this->client->folders->rename($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FolderRenameParams::with(
            folderPath: '/path/of/folder',
            newFolderName: 'new-folder-name',
            purgeCache: true,
        );
        $result = $this->client->folders->rename($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
