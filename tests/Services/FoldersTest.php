<?php

namespace Tests\Services;

use Imagekit\Client;
use Imagekit\Folders\FolderCopyResponse;
use Imagekit\Folders\FolderDeleteResponse;
use Imagekit\Folders\FolderMoveResponse;
use Imagekit\Folders\FolderNewResponse;
use Imagekit\Folders\FolderRenameResponse;
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
            privateKey: 'My Private Key',
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderNewResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderNewResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->delete(folderPath: '/folder/to/delete/');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->delete(folderPath: '/folder/to/delete/');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderDeleteResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderCopyResponse::class, $result);
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
            includeVersions: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderCopyResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderMoveResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderMoveResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderRenameResponse::class, $result);
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->folders->rename(
            folderPath: '/path/of/folder',
            newFolderName: 'new-folder-name',
            purgeCache: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FolderRenameResponse::class, $result);
    }
}
