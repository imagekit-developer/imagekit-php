<?php

namespace Tests\Services;

use Imagekit\Client;
use Imagekit\Core\Util;
use Imagekit\Files\File;
use Imagekit\Files\FileCopyResponse;
use Imagekit\Files\FileMoveResponse;
use Imagekit\Files\FileRenameResponse;
use Imagekit\Files\FileUpdateResponse;
use Imagekit\Files\FileUploadResponse;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
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

        $result = $this->client->files->update('fileId');

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

        $result = $this->client->files->copy(
            destinationPath: '/folder/to/copy/into/',
            sourceFilePath: '/path/to/file.jpg',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileCopyResponse::class, $result);
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

        $result = $this->client->files->move(
            destinationPath: '/folder/to/move/into/',
            sourceFilePath: '/path/to/file.jpg',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileMoveResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileMoveResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileRenameResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileRenameResponse::class, $result);
    }

    #[Test]
    public function testUpload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->upload(file: 'file', fileName: 'fileName');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
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
            checks: '"request.folder" : "marketing/"\n',
            customCoordinates: 'customCoordinates',
            customMetadata: ['brand' => 'bar', 'color' => 'bar'],
            description: 'Running shoes',
            expire: 0,
            extensions: [
                [
                    'name' => 'remove-bg',
                    'options' => [
                        'addShadow' => true,
                        'bgColor' => 'bg_color',
                        'bgImageURL' => 'bg_image_url',
                        'semitransparency' => true,
                    ],
                ],
                [
                    'maxTags' => 5, 'minConfidence' => 95, 'name' => 'google-auto-tagging',
                ],
                ['name' => 'ai-auto-description'],
                [
                    'name' => 'ai-tasks',
                    'tasks' => [
                        [
                            'instruction' => 'What types of clothing items are visible in this image?',
                            'type' => 'select_tags',
                            'maxSelections' => 1,
                            'minSelections' => 0,
                            'vocabulary' => [
                                'shirt', 'tshirt', 'dress', 'trousers', 'jacket',
                            ],
                        ],
                        [
                            'instruction' => 'Is this a luxury or high-end fashion item?',
                            'type' => 'yes_no',
                            'onNo' => [
                                'addTags' => ['luxury', 'premium'],
                                'removeTags' => ['budget', 'affordable'],
                                'setMetadata' => [
                                    ['field' => 'price_range', 'value' => 'premium'],
                                ],
                                'unsetMetadata' => [['field' => 'price_range']],
                            ],
                            'onUnknown' => [
                                'addTags' => ['luxury', 'premium'],
                                'removeTags' => ['budget', 'affordable'],
                                'setMetadata' => [
                                    ['field' => 'price_range', 'value' => 'premium'],
                                ],
                                'unsetMetadata' => [['field' => 'price_range']],
                            ],
                            'onYes' => [
                                'addTags' => ['luxury', 'premium'],
                                'removeTags' => ['budget', 'affordable'],
                                'setMetadata' => [
                                    ['field' => 'price_range', 'value' => 'premium'],
                                ],
                                'unsetMetadata' => [['field' => 'price_range']],
                            ],
                        ],
                    ],
                ],
                ['id' => 'ext_abc123', 'name' => 'saved-extension'],
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
            transformation: [
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
            useUniqueFileName: true,
            webhookURL: 'https://example.com',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
    }
}
