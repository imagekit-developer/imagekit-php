<?php

namespace ImageKit\Tests\ImageKit\Manage;


use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

/**
 *
 */
final class FileTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     *
     */
    public function testListFilesWithEmptyValidParameters()
    {
        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->listFiles();

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals([
            'type' => 'file',
            'name' => 'default-image.jpg',
            'fileId' => '5de4fb65c851e55df73abe8d',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
            'fileType' => 'image',
            'filePath' => '/default-image.jpg',
        ], $el);
    }

    private function stubHttpClient($methodName, $response)
    {
        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method($methodName)->willReturn($response);

        $closure = function () use ($stub) {
            $this->httpClient = $stub;
        };
        $doClosure = $closure->bindTo($this->client, ImageKit::class);
        $doClosure();
    }

    /**
     *
     */
    public function testListFilesWithValidParameters()
    {
        $parameters = [
            'tags' => [],
            'includeFolder' => true
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->listFiles($parameters);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals([
            'type' => 'file',
            'name' => 'default-image.jpg',
            'fileId' => '5de4fb65c851e55df73abe8d',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
            'fileType' => 'image',
            'filePath' => '/default-image.jpg',
        ], $el);
    }

    /**
     *
     */
    public function testGetDetailsWithEmptyFileId()
    {
        $fileId = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'type' => 'file',
                'name' => 'Kishan_2ZgC5VGZI',
                'fileId' => '5df36759adf3f523d81dd94f',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI',
                'fileType' => 'image',
                'filePath' => '/Kishan_2ZgC5VGZI',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileDetails($fileId);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testGetFileDetailsWithValidFileId()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'type' => 'file',
                'name' => 'Kishan_2ZgC5VGZI',
                'fileId' => '5df36759adf3f523d81dd94f',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI',
                'fileType' => 'image',
                'filePath' => '/Kishan_2ZgC5VGZI',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileDetails($fileId);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals([
            'type' => 'file',
            'name' => 'Kishan_2ZgC5VGZI',
            'fileId' => '5df36759adf3f523d81dd94f',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI',
            'fileType' => 'image',
            'filePath' => '/Kishan_2ZgC5VGZI',
        ], $el);
    }

    /**
     * @deprecated
     */
    public function testDeprecatedGetFileDetailsWithValidFileId()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'type' => 'file',
                'name' => 'Kishan_2ZgC5VGZI',
                'fileId' => '5df36759adf3f523d81dd94f',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI',
                'fileType' => 'image',
                'filePath' => '/Kishan_2ZgC5VGZI',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getDetails($fileId);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals([
            'type' => 'file',
            'name' => 'Kishan_2ZgC5VGZI',
            'fileId' => '5df36759adf3f523d81dd94f',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI',
            'fileType' => 'image',
            'filePath' => '/Kishan_2ZgC5VGZI',
        ], $el);
    }

    // Get details

    /**
     *
     */
    public function testGetFileMetaDataDetailsWithEmptyFileId()
    {
        $fileId = '';

        //5df36759adf3f523d81dd94f
        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'height' => 3214,
                'width' => 3948,
                'size' => 207097,
                'format' => 'jpg',
                'hasColorProfile' => true,
                'quality' => 90,
                'density' => 300,
                'hasTransparency' => false,
                'exif' => [
                    'image' => [
                        'ImageWidth' => 4584,
                        'ImageHeight' => 3334,
                        'BitsPerSample' => [8, 8, 8],
                        'PhotometricInterpretation' => 2,
                        'ImageDescription' => 'Character illustration of people holding creative ideas icons',
                        'Orientation' => 1,
                        'SamplesPerPixel' => 3,
                        'XResolution' => 300,
                        'YResolution' => 300,
                        'ResolutionUnit' => 2,
                        'Software' => 'Adobe Photoshop CC 2019 (Windows)',
                        'ModifyDate' => '2019=>05=>25 10=>16=>49',
                        'Artist' => 'busbus',
                        'Copyright' => 'Rawpixel Ltd.',
                        'ExifOffset' => 356
                    ],
                    'thumbnail' => [
                        'Compression' => 6,
                        'XResolution' => 72,
                        'YResolution' => 72,
                        'ResolutionUnit' => 2,
                        'ThumbnailOffset' => 506,
                        'ThumbnailLength' => 6230,
                    ],
                    'exif' => [
                        'ExifVersion' => '0221',
                        'ColorSpace' => 65535,
                        'ExifImageWidth' => 3948,
                        'ExifImageHeight' => 3214
                    ],
                    'gps' => [],
                    'interoperability' => [],
                    'makernote' => [],
                ],
                'pHash' => 'd1813e2fc22c7b2f',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetaData($fileId);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testGetFileMetaDataDetails()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'height' => 3214,
                'width' => 3948,
                'size' => 207097,
                'format' => 'jpg',
                'hasColorProfile' => true,
                'quality' => 90,
                'density' => 300,
                'hasTransparency' => false,
                'exif' => [
                    'image' => [
                        'ImageWidth' => 4584,
                        'ImageHeight' => 3334,
                        'BitsPerSample' => [8, 8, 8],
                        'PhotometricInterpretation' => 2,
                        'ImageDescription' => 'Character illustration of people holding creative ideas icons',
                        'Orientation' => 1,
                        'SamplesPerPixel' => 3,
                        'XResolution' => 300,
                        'YResolution' => 300,
                        'ResolutionUnit' => 2,
                        'Software' => 'Adobe Photoshop CC 2019 (Windows)',
                        'ModifyDate' => '2019=>05=>25 10=>16=>49',
                        'Artist' => 'busbus',
                        'Copyright' => 'Rawpixel Ltd.',
                        'ExifOffset' => 356
                    ],
                    'thumbnail' => [
                        'Compression' => 6,
                        'XResolution' => 72,
                        'YResolution' => 72,
                        'ResolutionUnit' => 2,
                        'ThumbnailOffset' => 506,
                        'ThumbnailLength' => 6230,
                    ],
                    'exif' => [
                        'ExifVersion' => '0221',
                        'ColorSpace' => 65535,
                        'ExifImageWidth' => 3948,
                        'ExifImageHeight' => 3214
                    ],
                    'gps' => [],
                    'interoperability' => [],
                    'makernote' => [],
                ],
                'pHash' => 'd1813e2fc22c7b2f',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetaData($fileId);

        $el = get_object_vars($response->success[0]);

        FileTest::assertNull($response->err);
        FileTest::assertEquals(207097, $el['size']);
    }

    /**
     * @deprecated
     */
    public function testDeprecatedGetFileMetaDataDetails()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'height' => 3214,
                'width' => 3948,
                'size' => 207097,
                'format' => 'jpg',
                'hasColorProfile' => true,
                'quality' => 90,
                'density' => 300,
                'hasTransparency' => false,
                'exif' => [
                    'image' => [
                        'ImageWidth' => 4584,
                        'ImageHeight' => 3334,
                        'BitsPerSample' => [8, 8, 8],
                        'PhotometricInterpretation' => 2,
                        'ImageDescription' => 'Character illustration of people holding creative ideas icons',
                        'Orientation' => 1,
                        'SamplesPerPixel' => 3,
                        'XResolution' => 300,
                        'YResolution' => 300,
                        'ResolutionUnit' => 2,
                        'Software' => 'Adobe Photoshop CC 2019 (Windows)',
                        'ModifyDate' => '2019=>05=>25 10=>16=>49',
                        'Artist' => 'busbus',
                        'Copyright' => 'Rawpixel Ltd.',
                        'ExifOffset' => 356
                    ],
                    'thumbnail' => [
                        'Compression' => 6,
                        'XResolution' => 72,
                        'YResolution' => 72,
                        'ResolutionUnit' => 2,
                        'ThumbnailOffset' => 506,
                        'ThumbnailLength' => 6230,
                    ],
                    'exif' => [
                        'ExifVersion' => '0221',
                        'ColorSpace' => 65535,
                        'ExifImageWidth' => 3948,
                        'ExifImageHeight' => 3214
                    ],
                    'gps' => [],
                    'interoperability' => [],
                    'makernote' => [],
                ],
                'pHash' => 'd1813e2fc22c7b2f',
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getMetaData($fileId);

        $el = get_object_vars($response->success[0]);

        FileTest::assertNull($response->err);
        FileTest::assertEquals(207097, $el['size']);
    }


    // Get MetaData

    /**
     *
     */
    public function testWhileDeletingMissingFileIdParameter()
    {

        $fileId = '';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('delete', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteFile($fileId);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testDeleteFileWhenSuccessful()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('delete', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteFile($fileId);

        FileTest::assertNull($response->err);
    }

    // Delete Files

    /**
     *
     */
    public function testBulkFileDeleteWhenMissingFileIdsParameter()
    {

        $fileIds = [];

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('FileIds parameter is missing.', $response->err->message);
    }

    /**
     *
     */
    public function testBulkFileDeleteWhenSuccessful()
    {

        $fileIds = ['6604876475937', '8242194892418'];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'successfullyDeletedFileIds' => $fileIds,
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkDeleteFiles($fileIds);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals($fileIds[0], $el['successfullyDeletedFileIds'][0]);
    }


    /**
     * @deprecated
     */
    public function testDeprecatedBulkFileDeleteByIdsWhenSuccessful()
    {

        $fileIds = ['6604876475937', '8242194892418'];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'successfullyDeletedFileIds' => $fileIds,
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkFileDeleteByIds(['fileIds' => $fileIds]);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals($fileIds[0], $el['successfullyDeletedFileIds'][0]);
    }



    /**
     *
     */
    public function testCopyFileWhenSourceIsEmpty()
    {
        $source = '';
        $destination = '/destination';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Missing sourceFilePath and/or destinationPath for copy file.', $response->err->message);
    }

    /**
     *
     */
    public function testCopyFileWhenDestinationIsEmpty()
    {
        $source = '/source';
        $destination = '';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Missing sourceFilePath and/or destinationPath for copy file.', $response->err->message);
    }

    /**
     *
     */
    public function testCopyFileSuccessful()
    {
        $source = '/source';
        $destination = '/destination';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNull($response->err);
    }

    /**
     *
     */
    public function testMoveFileWhenSourceIsEmpty()
    {
        $source = '';
        $destination = '/destination';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Missing sourceFilePath and/or destinationPath for copy file.', $response->err->message);
    }

    /**
     *
     */
    public function testMoveFileWhenDestinationIsEmpty()
    {
        $source = '/source';
        $destination = '';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Missing sourceFilePath and/or destinationPath for copy file.', $response->err->message);
    }

    /**
     *
     */
    public function testMoveFileSuccessful()
    {
        $source = '/source';
        $destination = '/destination';

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFile($source, $destination);

        FileTest::assertNull($response->success);
        FileTest::assertNull($response->err);
    }

    /**
     *
     */
    public function testRenameFileEmptyFilePath()
    {
        $filePath = '';
        $newFileName = 'new-name';

        $mockBodyResponse = Utils::streamFor(json_encode([]));

        $this->stubHttpClient('put', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName);

        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Rename File Parameters are invalid.', $response->err->message);
    }

    /**
     *
     */
    public function testRenameFileEmptyNewFileName()
    {
        $filePath = '/filePath';
        $newFileName = '';

        $mockBodyResponse = Utils::streamFor(json_encode([]));

        $this->stubHttpClient('put', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName);

        FileTest::assertNotNull($response->err);
        FileTest::assertEquals('Rename File Parameters are invalid.', $response->err->message);
    }

    /**
     *
     */
    public function testRenameFileSuccess()
    {
        $filePath = '/filePath';
        $newFileName = 'new-file';

        $mockBodyResponse = Utils::streamFor(json_encode([]));

        $this->stubHttpClient('put', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName);

        FileTest::assertNotNull($response->success);
        FileTest::assertNull($response->err);
    }

    /**
     *
     */
    public function testRenameFilePurgeCacheFalse()
    {
        $filePath = '/filePath';
        $newFileName = 'new-file';

        $mockBodyResponse = Utils::streamFor(json_encode([]));

        $this->stubHttpClient('put', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName, false);

        FileTest::assertNotNull($response->success);
        FileTest::assertNull($response->err);
    }

    /**
     *
     */
    public function testRenameFilePurgeCache()
    {
        $filePath = '/filePath';
        $newFileName = 'new-file';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'purgeCacheId' => '598821f949c0a938d57563bd']));

        $this->stubHttpClient('put', new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName, true);

        FileTest::assertNotNull($response->success);
        FileTest::assertNull($response->err);
        FileTest::assertEquals('598821f949c0a938d57563bd', $response->success->purgeCacheId);
    }

    /**
     *
     */
    public function testRenameFilePurgeCacheFailed()
    {
        $filePath = '/filePath';
        $newFileName = 'new-file';

        $mockBodyResponse = Utils::streamFor(json_encode([
            'message' => 'File renamed successfully but we could not purge the CDN cache for old URL because of rate limits on purge API.',
            'help' => 'For support kindly contact us at support@imagekit.io .',
            'reason' => 'PURGE_FAILED'
        ]));

        $this->stubHttpClient('put', new Response(207, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($filePath, $newFileName, true);

        FileTest::assertNotNull($response->success);
        FileTest::assertNull($response->err);
        FileTest::assertEquals('File renamed successfully but we could not purge the CDN cache for old URL because of rate limits on purge API.', $response->success->message);
        FileTest::assertEquals('For support kindly contact us at support@imagekit.io .', $response->success->help);
        FileTest::assertEquals('PURGE_FAILED', $response->success->reason);
    }

    /**
     *
     */
    public function testUpdateFileDetailsWhenFileIDTagsAndCustomParameterIsPassed()
    {

        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
        ]));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        $el = get_object_vars($response->success);
        FileTest::assertNull($response->err);
        FileTest::assertEquals([
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
        ], $el);
    }

    /**
     * @deprecated
     */
    public function testDeprecatedUpdateFileDetailsWhenFileIDTagsAndCustomParameterIsPassed()
    {

        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
        ]));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateDetails($fileId, $updateData);

        $el = get_object_vars($response->success);
        FileTest::assertNull($response->err);
        FileTest::assertEquals([
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
        ], $el);
    }

    /**
     *
     */
    public function testUpdateFileDetailsWhenFileIDParameterIsNotPassed()
    {
        $fileId = '';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'fileId' => '598821f949c0a938d57563bd',
                'type' => 'file',
                'name' => 'file1.jpg',
                'filePath' => '/images/products/file1.jpg',
                'tags' => ['t-shirt', 'round-neck', 'sale2019'],
                'isPrivateFile' => false,
                'customCoordinates' => null,
                'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
                'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
                'fileType' => 'image'
            ],
        ]));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->err->message);
    }


    // Update details

    /**
     *
     */
    public function testUpdateFileDetailsWhenUpdateDataIsNotAnArray()
    {


        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = 'Keegan Trail';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'fileId' => '598821f949c0a938d57563bd',
                'type' => 'file',
                'name' => 'file1.jpg',
                'filePath' => '/images/products/file1.jpg',
                'tags' => ['t-shirt', 'round-neck', 'sale2019'],
                'isPrivateFile' => false,
                'customCoordinates' => null,
                'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
                'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
                'fileType' => 'image'
            ],
        ]));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing file update data for this request', $response->err->message);
    }

    /**
     *
     */
    public function testUpdateFileDetailsWhenUpdateDataTagIsInvalid()
    {

        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ''
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'fileId' => '598821f949c0a938d57563bd',
                'type' => 'file',
                'name' => 'file1.jpg',
                'filePath' => '/images/products/file1.jpg',
                'tags' => null,
                'isPrivateFile' => false,
                'customCoordinates' => null,
                'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
                'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
                'fileType' => 'image'
            ],
        ]));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Invalid tags parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testUpdateFileDetailsWhenUpdateCustomCoordinatesAreInvalid()
    {

        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => [],
            'tags' => ['tag1', 'tag2']
        ];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'fileId' => '598821f949c0a938d57563bd',
                'type' => 'file',
                'name' => 'file1.jpg',
                'filePath' => '/images/products/file1.jpg',
                'tags' => null,
                'isPrivateFile' => false,
                'customCoordinates' => null,
                'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
                'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
                'fileType' => 'image'
            ])
        );

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Invalid customCoordinates parameter for this request', $response->err->message);
    }

    public function testBulkAddTagsWhenFileIdsAreEmpty()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing bulk tag update data for this request', $response->err->message);
    }

    public function testBulkAddTagsWhenTagsAreEmpty()
    {
        $fileIds = ['5df36759adf3f523d81dd94f'];
        $tags = [];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing bulk tag update data for this request', $response->err->message);
    }

    // Bulk Add Tags

    public function testBulkAddTagsSuccessful()
    {
        $fileIds = ['5df36759adf3f523d81dd94f'];
        $tags = ['testing_tags_!'];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkAddTags($fileIds, $tags);

        $obj = get_object_vars($response->success);
        FileTest::assertEquals(['successfullyUpdatedFileIds' => ['5df36759adf3f523d81dd94f']], $obj);
    }

    public function testBulkRemoveTagsWhenFileIdsAreEmpty()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('delete', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing bulk tag update data for this request', $response->err->message);
    }

    public function testBulkRemoveTagsWhenTagsAreEmpty()
    {
        $fileIds = ['5df36759adf3f523d81dd94f'];
        $tags = [];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('delete', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing bulk tag update data for this request', $response->err->message);
    }


    // Bulk Remove Tags

    public function testBulkRemoveTagsSuccessful()
    {
        $fileIds = ['5df36759adf3f523d81dd94f'];
        $tags = ['testing_tags_!'];

        $mockBodyResponse = Utils::streamFor(
            json_encode([
                'successfullyUpdatedFileIds' => $fileIds
            ])
        );

        $this->stubHttpClient('delete', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        $obj = get_object_vars($response->success);
        FileTest::assertEquals(['successfullyUpdatedFileIds' => ['5df36759adf3f523d81dd94f']], $obj);
    }

    // Purge  Details

    /**
     *
     */
    public function testPurgeFileCacheWithoutUrlPatrameter()
    {

        $urlParam = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeCache($urlParam);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing URL parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testPurgeCache()
    {

        $urlParam = 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeCache($urlParam);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('598821f949c0a938d57563bd', $el['requestId']);
    }


    /**
     * @deprecated
     */
    public function testDeprecatedPurgeFileCacheApi()
    {

        $urlParam = 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeFileCacheApi($urlParam);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('598821f949c0a938d57563bd', $el['requestId']);
    }

    /**
     * @deprecated
     */
    public function testDeprecatedPurgeCacheApi()
    {

        $urlParam = 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeCacheApi($urlParam);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('598821f949c0a938d57563bd', $el['requestId']);
    }

    // Purge Cache Status API

    /**
     *
     */
    public function testPurgeFileCacheStatusWithoutRequestId()
    {
        $requestId = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->getPurgeCacheStatus($requestId);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing Request ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testPurgeFileCacheStatus()
    {
        $requestId = '598821f949c0a938d57563bd';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->getPurgeCacheStatus($requestId);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('Pending', $el['status']);
    }

    /**
     * @deprecated
     */
    public function testDeprecatedPurgeCacheApiStatusStatus()
    {
        $requestId = '598821f949c0a938d57563bd';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeCacheApiStatus($requestId);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('Pending', $el['status']);
    }

    /**
     *
     */
    public function testDeprecatedPurgeFileCacheApiStatusStatus()
    {
        $requestId = '598821f949c0a938d57563bd';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->purgeFileCacheApiStatus($requestId);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('Pending', $el['status']);
    }

    // Remote URL Metadata

    /**
     *
     */
    public function testGetFileMetadataFromRemoteURLWhenURLParamIsMissing()
    {
        $url = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            ['pHash' => 'f06830ca9f1e3e90'],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetadataFromRemoteURL($url);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Your request is missing the url query paramater.', $response->err->message);
    }

    /**
     *
     */
    public function testGetFileMetadataFromRemoteURLWhenSuccessful()
    {
        $url = 'https://dummy.example.com/';
        $phash = '1578156593879';

        $mockBodyResponse = Utils::streamFor(json_encode([
            ['pHash' => $phash],
        ]));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetadataFromRemoteURL($url);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals($phash, $el['pHash']);
    }

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );
    }

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
