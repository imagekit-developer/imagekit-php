<?php

namespace Tests\Resources;

use ImageKit\Client;
use ImageKit\Files\FileAddTagsParams;
use ImageKit\Files\FileCopyParams;
use ImageKit\Files\FileListParams;
use ImageKit\Files\FileMoveParams;
use ImageKit\Files\FileRemoveAITagsParams;
use ImageKit\Files\FileRemoveTagsParams;
use ImageKit\Files\FileRenameParams;
use ImageKit\Files\FileUploadV1Params;
use ImageKit\Files\FileUploadV2Params;
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
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = (new FileListParams);
        $result = $this->client->files->list($params);

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
    public function testAddTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileAddTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->addTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileAddTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->addTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopy(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileCopyParams::with(
            destinationPath: '/folder/to/copy/into/',
            sourceFilePath: '/path/to/file.jpg',
        );
        $result = $this->client->files->copy($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileCopyParams::with(
            destinationPath: '/folder/to/copy/into/',
            sourceFilePath: '/path/to/file.jpg',
            includeFileVersions: false,
        );
        $result = $this->client->files->copy($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMove(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileMoveParams::with(
            destinationPath: '/folder/to/move/into/',
            sourceFilePath: '/path/to/file.jpg',
        );
        $result = $this->client->files->move($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileMoveParams::with(
            destinationPath: '/folder/to/move/into/',
            sourceFilePath: '/path/to/file.jpg',
        );
        $result = $this->client->files->move($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRemoveAITagsParams::with(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );
        $result = $this->client->files->removeAITags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRemoveAITagsParams::with(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );
        $result = $this->client->files->removeAITags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRemoveTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->removeTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRemoveTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->removeTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRename(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRenameParams::with(
            filePath: '/path/to/file.jpg',
            newFileName: 'newFileName.jpg'
        );
        $result = $this->client->files->rename($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRenameWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileRenameParams::with(
            filePath: '/path/to/file.jpg',
            newFileName: 'newFileName.jpg',
            purgeCache: true,
        );
        $result = $this->client->files->rename($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadV1(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileUploadV1Params::with(
            file: 'https://www.example.com/rest-of-the-image-path.jpg',
            fileName: 'fileName',
        );
        $result = $this->client->files->uploadV1($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadV1WithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileUploadV1Params::with(
            file: 'https://www.example.com/rest-of-the-image-path.jpg',
            fileName: 'fileName',
            token: 'token',
            checks: "\"request.folder\" : \"marketing/\"\n",
            customCoordinates: 'customCoordinates',
            customMetadata: "\"\n  {\n    \"brand\": \"Nike\",\n    \"color\":\"red\"\n  }\n\"\n",
            expire: 'expire',
            extensions: "\"\n[\n  {\"name\":\"remove-bg\",\"options\":{\"add_shadow\":true,\"bg_colour\":\"green\"}},\n  {\"name\":\"google-auto-tagging\",\"maxTags\":5,\"minConfidence\":95}\n]\n\"\n",
            folder: 'folder',
            isPrivateFile: 'true',
            isPublished: 'true',
            overwriteAITags: 'true',
            overwriteCustomMetadata: 'true',
            overwriteFile: 'overwriteFile',
            overwriteTags: 'true',
            publicKey: 'publicKey',
            responseFields: 'responseFields',
            signature: 'signature',
            tags: 't-shirt,round-neck,men',
            transformation: "'{\"pre\":\"width:300,height:300,quality:80\",\"post\":[{\"type\":\"thumbnail\",\"value\":\"width:100,height:100\"}]}'\n",
            useUniqueFileName: 'true',
            webhookURL: 'webhookUrl',
        );
        $result = $this->client->files->uploadV1($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadV2(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileUploadV2Params::with(
            file: 'https://www.example.com/rest-of-the-image-path.jpg',
            fileName: 'fileName',
        );
        $result = $this->client->files->uploadV2($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadV2WithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileUploadV2Params::with(
            file: 'https://www.example.com/rest-of-the-image-path.jpg',
            fileName: 'fileName',
            token: 'token',
            checks: "\"request.folder\" : \"marketing/\"\n",
            customCoordinates: 'customCoordinates',
            customMetadata: "\"\n  {\n    \"brand\": \"Nike\",\n    \"color\":\"red\"\n  }\n\"\n",
            extensions: "\"\n[\n  {\"name\":\"remove-bg\",\"options\":{\"add_shadow\":true,\"bg_colour\":\"green\"}},\n  {\"name\":\"google-auto-tagging\",\"maxTags\":5,\"minConfidence\":95}\n]\n\"\n",
            folder: 'folder',
            isPrivateFile: 'true',
            isPublished: 'true',
            overwriteAITags: 'true',
            overwriteCustomMetadata: 'true',
            overwriteFile: 'overwriteFile',
            overwriteTags: 'true',
            responseFields: 'responseFields',
            tags: 't-shirt,round-neck,men',
            transformation: "'{\"pre\":\"width:300,height:300,quality:80\",\"post\":[{\"type\":\"thumbnail\",\"value\":\"width:100,height:100\"}]}'\n",
            useUniqueFileName: 'true',
            webhookURL: 'webhookUrl',
        );
        $result = $this->client->files->uploadV2($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
