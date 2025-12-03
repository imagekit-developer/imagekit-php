<?php

namespace Tests\Services;

use ImageKit\Client;
use ImageKit\Files\File;
use ImageKit\Files\FileCopyResponse;
use ImageKit\Files\FileMoveResponse;
use ImageKit\Files\FileRenameResponse;
use ImageKit\Files\FileUpdateResponse;
use ImageKit\Files\FileUploadResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class FilesTest extends TestCase
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
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->update('fileId', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUpdateResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->delete('fileId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->copy([
            'destinationPath' => '/folder/to/copy/into/',
            'sourceFilePath' => '/path/to/file.jpg',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileCopyResponse::class, $result);
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->copy([
            'destinationPath' => '/folder/to/copy/into/',
            'sourceFilePath' => '/path/to/file.jpg',
            'includeFileVersions' => false,
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileCopyResponse::class, $result);
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->get('fileId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(File::class, $result);
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->move([
            'destinationPath' => '/folder/to/move/into/',
            'sourceFilePath' => '/path/to/file.jpg',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileMoveResponse::class, $result);
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->move([
            'destinationPath' => '/folder/to/move/into/',
            'sourceFilePath' => '/path/to/file.jpg',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileMoveResponse::class, $result);
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->rename([
            'filePath' => '/path/to/file.jpg', 'newFileName' => 'newFileName.jpg',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileRenameResponse::class, $result);
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->rename([
            'filePath' => '/path/to/file.jpg',
            'newFileName' => 'newFileName.jpg',
            'purgeCache' => true,
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileRenameResponse::class, $result);
    }

    #[Test]
    public function testUpload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->upload([
            'file' => file_get_contents(__FILE__) ?: '', 'fileName' => 'fileName',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->upload([
            'file' => file_get_contents(__FILE__) ?: '',
            'fileName' => 'fileName',
            'token' => 'token',
            'checks' => '"request.folder" : "marketing/"\n',
            'customCoordinates' => 'customCoordinates',
            'customMetadata' => ['brand' => 'bar', 'color' => 'bar'],
            'description' => 'Running shoes',
            'expire' => 0,
            'extensions' => [
                [
                    'name' => 'remove-bg',
                    'options' => [
                        'add_shadow' => true,
                        'bg_color' => 'bg_color',
                        'bg_image_url' => 'bg_image_url',
                        'semitransparency' => true,
                    ],
                ],
                [
                    'maxTags' => 5, 'minConfidence' => 95, 'name' => 'google-auto-tagging',
                ],
                ['name' => 'ai-auto-description'],
            ],
            'folder' => 'folder',
            'isPrivateFile' => true,
            'isPublished' => true,
            'overwriteAITags' => true,
            'overwriteCustomMetadata' => true,
            'overwriteFile' => true,
            'overwriteTags' => true,
            'publicKey' => 'publicKey',
            'responseFields' => ['tags', 'customCoordinates', 'isPrivateFile'],
            'signature' => 'signature',
            'tags' => ['t-shirt', 'round-neck', 'men'],
            'transformation' => [
                'post' => [
                    ['type' => 'thumbnail', 'value' => 'w-150,h-150'],
                    [
                        'protocol' => 'dash',
                        'type' => 'abs',
                        'value' => 'sr-240_360_480_720_1080',
                    ],
                ],
                'pre' => 'w-300,h-300,q-80',
            ],
            'useUniqueFileName' => true,
            'webhookUrl' => 'https://example.com',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
    }
}
