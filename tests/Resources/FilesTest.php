<?php

namespace Tests\Resources;

use ImageKit\Client;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;
use ImageKit\Shared\RemovedotBgExtension\Options;
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
            privateAPIKey: 'My Private API Key',
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

        $result = $this->client->files->update('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->delete('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->copy(
            destinationPath: '/folder/to/copy/into/',
            sourceFilePath: '/path/to/file.jpg',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->copy(
            destinationPath: '/folder/to/copy/into/',
            sourceFilePath: '/path/to/file.jpg',
            includeFileVersions: false,
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->get('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->move(
            destinationPath: '/folder/to/move/into/',
            sourceFilePath: '/path/to/file.jpg',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->move(
            destinationPath: '/folder/to/move/into/',
            sourceFilePath: '/path/to/file.jpg',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->rename(
            filePath: '/path/to/file.jpg',
            newFileName: 'newFileName.jpg'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->rename(
            filePath: '/path/to/file.jpg',
            newFileName: 'newFileName.jpg',
            purgeCache: true,
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->upload(file: 'file', fileName: 'fileName');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->upload(
            file: 'file',
            fileName: 'fileName',
            token: 'token',
            checks: "\"request.folder\" : \"marketing/\"\n",
            customCoordinates: 'customCoordinates',
            customMetadata: ['brand' => 'bar', 'color' => 'bar'],
            description: 'Running shoes',
            expire: 0,
            extensions: [
                RemovedotBgExtension::with(name: 'remove-bg')
                    ->withOptions(
                        (new Options)
                            ->withAddShadow(true)
                            ->withBgColor('bg_color')
                            ->withBgImageURL('bg_image_url')
                            ->withSemitransparency(true),
                    ),
                AutoTaggingExtension::with(
                    maxTags: 5,
                    minConfidence: 95,
                    name: 'google-auto-tagging'
                ),
            ],
            folder: 'folder',
            isPrivateFile: true,
            isPublished: true,
            overwriteAITags: true,
            overwriteCustomMetadata: true,
            overwriteFile: true,
            overwriteTags: true,
            publicKey: 'publicKey',
            responseFields: ['tags', 'customCoordinates', 'isPrivateFile'],
            signature: 'signature',
            tags: ['t-shirt', 'round-neck', 'men'],
            transformation: (new Transformation)
                ->withPost(
                    [
                        GenerateAThumbnail::with(type: 'thumbnail')->withValue('w-150,h-150'),
                        AdaptiveBitrateStreaming::with(
                            protocol: 'dash',
                            type: 'abs',
                            value: 'sr-240_360_480_720_1080'
                        ),
                    ],
                )
                ->withPre('w-300,h-300,q-80'),
            useUniqueFileName: true,
            webhookURL: 'https://example.com',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
