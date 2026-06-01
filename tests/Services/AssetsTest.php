<?php

namespace Tests\Services;

use ImageKit\Assets\AssetCopyResponse;
use ImageKit\Assets\AssetMoveResponse;
use ImageKit\Assets\AssetRenameResponse;
use ImageKit\Assets\AssetUpdateResponse;
use ImageKit\Assets\UploadResponse;
use ImageKit\Client;
use ImageKit\Core\FileParam;
use ImageKit\Core\Util;
use ImageKit\Cursor;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AssetsTest extends TestCase
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->update('asset_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->assets->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Cursor::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertNotNull($item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->delete('asset_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->copy(
            destinationPath: '/folder/to/copy/into/',
            sourcePath: '/path/to/file.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetCopyResponse::class, $result);
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->copy(
            destinationPath: '/folder/to/copy/into/',
            sourcePath: '/path/to/file.jpg',
            includeVersions: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetCopyResponse::class, $result);
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->get('asset_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->move(
            destinationPath: '/folder/to/move/into/',
            sourcePath: '/path/to/file.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetMoveResponse::class, $result);
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->move(
            destinationPath: '/folder/to/move/into/',
            sourcePath: '/path/to/file.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetMoveResponse::class, $result);
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->rename(
            newName: 'new_file_name.jpg',
            path: '/path/to/file.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetRenameResponse::class, $result);
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->rename(
            newName: 'new_file_name.jpg',
            path: '/path/to/file.jpg',
            purgeCache: true
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetRenameResponse::class, $result);
    }

    #[Test]
    public function testUpload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->upload(
            file: FileParam::fromString('Example data', filename: uniqid('file-upload-', true)),
            fileName: 'file_name',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UploadResponse::class, $result);
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->upload(
            file: FileParam::fromString('Example data', filename: uniqid('file-upload-', true)),
            fileName: 'file_name',
            token: 'token',
            checks: "\"request.folder\" : \"marketing/\"\n",
            customCoordinates: 'custom_coordinates',
            customMetadata: ['brand' => 'bar', 'color' => 'bar'],
            description: 'Running shoes',
            extensions: [
                [
                    'name' => 'remove-bg',
                    'options' => [
                        'addShadow' => true,
                        'bgColor' => 'bg_color',
                        'bgImageURL' => 'bg_image_url',
                        'semiTransparency' => true,
                    ],
                ],
                [
                    'name' => 'remove-bg',
                    'options' => [
                        'addShadow' => true,
                        'bgColor' => 'bg_color',
                        'bgImageURL' => 'bg_image_url',
                        'semiTransparency' => true,
                    ],
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
            overwrite: [
                'aiTags' => true,
                'customMetadata' => true,
                'file' => true,
                'tags' => true,
            ],
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
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UploadResponse::class, $result);
    }
}
