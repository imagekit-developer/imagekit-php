<?php

namespace Tests\Services;

use ImageKit\Client;
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

        $result = $this->client->folders->create(
            folderName: 'summer',
            parentFolderPath: '/product/images/'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->create(
            folderName: 'summer',
            parentFolderPath: '/product/images/'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->delete('/folder/to/delete/');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->delete('/folder/to/delete/');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->copy(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->copy(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->move(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->move(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->rename(
            folderPath: '/path/of/folder',
            newFolderName: 'new-folder-name'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->rename(
            folderPath: '/path/of/folder',
            newFolderName: 'new-folder-name'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
