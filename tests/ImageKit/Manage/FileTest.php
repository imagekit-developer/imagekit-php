<?php

namespace ImageKit\Tests\ImageKit\Manage;


use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Manage\File;
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

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );
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

    protected function tearDown(): void
    {
        $this->client = null;
    }

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

    // Get details

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


    // Get MetaData

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

    // Delete Files

    /**
     *
     */
    public function testWhileDeletingMissingFileIdParameter()
    {

        $fileId = '';

        $mockBodyResponse = Utils::streamFor();

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->deleteFile($fileId, $stub);

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

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->deleteFile($fileId, $stub);

        FileTest::assertNull($response->err);
    }

    // Bulk File Delete

    /**
     *
     */
    public function testBulkFileDeleteWhenMissingFileIdsParameter()
    {

        $options = '';

        $mockBodyResponse = Utils::streamFor();

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->bulkDeleteByFileIds($options, $stub);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('FileIds parameter is missing.', $response->err->message);
    }

    /**
     *
     */
    public function testBulkFileDeleteWhenSuccessful()
    {

        $fileIds = ['6604876475937', '8242194892418'];
        $options = [
            'fileIds' => $fileIds
        ];

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'successfullyDeletedFileIds' => $fileIds,
            ],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('rawPost')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->bulkDeleteByFileIds($options, $stub);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals($fileIds[0], $el['successfullyDeletedFileIds'][0]);
    }

    // Update details
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

    // Purge  Details

    /**
     *
     */
    public function testPurgeFileCacheApiWithoutUrlPatrameter()
    {

        $urlParam = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('post')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApi = new File();
        $response = $purgeCacheApi->purgeFileCacheApi($urlParam, $stub);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing URL parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testPurgeCacheApi()
    {

        $urlParam = 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'requestId' => '598821f949c0a938d57563bd',
            ],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('post')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApi = new File();
        $response = $purgeCacheApi->purgeFileCacheApi($urlParam, $stub);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('598821f949c0a938d57563bd', $el['requestId']);
    }

    // Purge  Cache API  Details

    /**
     *
     */
    public function testPurgeFileCacheApiStatusWithoutRequestId()
    {
        $requestId = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApiStatus = new File();
        $response = $purgeCacheApiStatus->purgeFileCacheApiStatus($requestId, $stub);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Missing Request ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testPurgeFileCacheApiStatus()
    {
        $requestId = '598821f949c0a938d57563bd';

        $mockBodyResponse = Utils::streamFor(json_encode([
            [
                'status' => 'Pending'
            ],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApiStatus = new File();
        $response = $purgeCacheApiStatus->purgeFileCacheApiStatus($requestId, $stub);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals('Pending', $el['status']);
    }

    /**
     *
     */
    public function testGetFileMetadataFromRemoteURLApiWhenURLParamIsMissing()
    {
        $url = '';

        $mockBodyResponse = Utils::streamFor(json_encode([
            ['pHash' => 'f06830ca9f1e3e90'],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->getFileMetadataFromRemoteURL($url, $stub);

        FileTest::assertNull($response->success);
        FileTest::assertEquals('Your request is missing the url query paramater.', $response->err->message);
    }

    /**
     *
     */
    public function testGetFileMetadataFromRemoteURLApiWhenSuccessful()
    {
        $url = 'https://dummy.example.com/';
        $phash = '1578156593879';

        $mockBodyResponse = Utils::streamFor(json_encode([
            ['pHash' => $phash],
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->getFileMetadataFromRemoteURL($url, $stub);

        $el = get_object_vars($response->success[0]);
        FileTest::assertEquals($phash, $el['pHash']);
    }
}
