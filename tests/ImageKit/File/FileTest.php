<?php

namespace ImageKit\Tests\ImageKit\File;

include_once __DIR__ . '/../../../src/ImageKit/Utils/transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/authorization.php';

use Faker;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7;

use ImageKit\File\File;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;
use function json_encode;

final class FileTest extends TestCase
{
    // List Files
    /** @test */
    public function testListFilesWhenParametersAreInvalid()
    {
        $parameters = "";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
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
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $listFiles = new File();
        $response = $listFiles->listFiles($parameters, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Invalid List Files Options ImageKit initialization", $response->err->message);
    }

    public function testListFilesWithEmptyValidParameters()
    {

        $parameters = array();

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
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
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $listFiles = new File();
        $response = $listFiles->listFiles($parameters, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals(array(
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
        ), $el);
    }

    public function testListFilesWithValidParameters()
    {
        $parameters = array(
            "tags" => array()
        );

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
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
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $listFiles = new File();
        $response = $listFiles->listFiles($parameters, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals(array(
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
        ), $el);
    }

    // Get details
    public function testGetDetailsWithEmptyFileId()
    {
        $the_file_id = "";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "type" => "file",
                "name" => "Kishan_2ZgC5VGZI",
                "fileId" => "5df36759adf3f523d81dd94f",
                "tags" => null,
                "customCoordinates" => null,
                "isPrivateFile" => false,
                "url" => "https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI",
                "thumbnail" => "https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI",
                "fileType" => "image",
                "filePath" => "/Kishan_2ZgC5VGZI",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $getDetails = new File();
        $response = $getDetails->getFileDetails($the_file_id, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing File ID parameter for this request", $response->err->message);
    }

    public function testGetFileDetailsWithValidFileId()
    {
        $faker = Faker\Factory::create();
        $the_file_id = "5df36759adf3f523d81dd94f";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "type" => "file",
                "name" => "Kishan_2ZgC5VGZI",
                "fileId" => "5df36759adf3f523d81dd94f",
                "tags" => null,
                "customCoordinates" => null,
                "isPrivateFile" => false,
                "url" => "https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI",
                "thumbnail" => "https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI",
                "fileType" => "image",
                "filePath" => "/Kishan_2ZgC5VGZI",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $getDetails = new File();
        $response = $getDetails->getFileDetails($the_file_id, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals(array(
            "type" => "file",
            "name" => "Kishan_2ZgC5VGZI",
            "fileId" => "5df36759adf3f523d81dd94f",
            "tags" => null,
            "customCoordinates" => null,
            "isPrivateFile" => false,
            "url" => "https://ik.imagekit.io/ot2cky3ujwa/Kishan_2ZgC5VGZI",
            "thumbnail" => "https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/Kishan_2ZgC5VGZI",
            "fileType" => "image",
            "filePath" => "/Kishan_2ZgC5VGZI",
        ), $el);
    }


    // Get MetaData
    public function testGetFileMetaDataDetailsWithEmptyFileId()
    {
        $the_file_id = "";

        //5df36759adf3f523d81dd94f
        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "height" => 3214,
                "width" => 3948,
                "size" => 207097,
                "format" => "jpg",
                "hasColorProfile" => true,
                "quality" => 90,
                "density" => 300,
                "hasTransparency" => false,
                "exif" => array(
                    "image" => array(
                        "ImageWidth" => 4584,
                        "ImageHeight" => 3334,
                        "BitsPerSample" => [8, 8, 8],
                        "PhotometricInterpretation" => 2,
                        "ImageDescription" => "Character illustration of people holding creative ideas icons",
                        "Orientation" => 1,
                        "SamplesPerPixel" => 3,
                        "XResolution" => 300,
                        "YResolution" => 300,
                        "ResolutionUnit" => 2,
                        "Software" => "Adobe Photoshop CC 2019 (Windows)",
                        "ModifyDate" => "2019=>05=>25 10=>16=>49",
                        "Artist" => "busbus",
                        "Copyright" => "Rawpixel Ltd.",
                        "ExifOffset" => 356
                    ),
                    "thumbnail" => array(
                        "Compression" => 6,
                        "XResolution" => 72,
                        "YResolution" => 72,
                        "ResolutionUnit" => 2,
                        "ThumbnailOffset" => 506,
                        "ThumbnailLength" => 6230,
                    ),
                    "exif" => array(
                        "ExifVersion" => "0221",
                        "ColorSpace" => 65535,
                        "ExifImageWidth" => 3948,
                        "ExifImageHeight" => 3214
                    ),
                    "gps" => array(),
                    "interoperability" => array(),
                    "makernote" => array(),
                ),
                "pHash" => "d1813e2fc22c7b2f",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $getMetaData = new File();

        $response = $getMetaData->getFileMetaData($the_file_id, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing File ID parameter for this request", $response->err->message);
    }

    public function testGetFileMetaDataDetails()
    {
        $the_file_id = "5df36759adf3f523d81dd94f";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "height" => 3214,
                "width" => 3948,
                "size" => 207097,
                "format" => "jpg",
                "hasColorProfile" => true,
                "quality" => 90,
                "density" => 300,
                "hasTransparency" => false,
                "exif" => array(
                    "image" => array(
                        "ImageWidth" => 4584,
                        "ImageHeight" => 3334,
                        "BitsPerSample" => [8, 8, 8],
                        "PhotometricInterpretation" => 2,
                        "ImageDescription" => "Character illustration of people holding creative ideas icons",
                        "Orientation" => 1,
                        "SamplesPerPixel" => 3,
                        "XResolution" => 300,
                        "YResolution" => 300,
                        "ResolutionUnit" => 2,
                        "Software" => "Adobe Photoshop CC 2019 (Windows)",
                        "ModifyDate" => "2019=>05=>25 10=>16=>49",
                        "Artist" => "busbus",
                        "Copyright" => "Rawpixel Ltd.",
                        "ExifOffset" => 356
                    ),
                    "thumbnail" => array(
                        "Compression" => 6,
                        "XResolution" => 72,
                        "YResolution" => 72,
                        "ResolutionUnit" => 2,
                        "ThumbnailOffset" => 506,
                        "ThumbnailLength" => 6230,
                    ),
                    "exif" => array(
                        "ExifVersion" => "0221",
                        "ColorSpace" => 65535,
                        "ExifImageWidth" => 3948,
                        "ExifImageHeight" => 3214
                    ),
                    "gps" => array(),
                    "interoperability" => array(),
                    "makernote" => array(),
                ),
                "pHash" => "d1813e2fc22c7b2f",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $getMetaData = new File();
        $response = $getMetaData->getFileMetaData($the_file_id, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertNull($response->err);
        assert: $this->assertEquals(207097, $el['size']);
    }

    // Delete Files
    public function testWhileDeletingMissingFileIdParameter()
    {
        $faker = Faker\Factory::create();

        $the_file_id = "";

        $mockBodyResponse = Psr7\stream_for("");

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->deleteFile($the_file_id, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing File ID parameter for this request", $response->err->message);
    }

    public function testDeleteFileWhenSuccessful()
    {
        $faker = Faker\Factory::create();
        $the_file_id = "5df36759adf3f523d81dd94f";

        $mockBodyResponse = Psr7\stream_for();

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(204, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->deleteFile($the_file_id, $stub);

        $this->assertNull($response->err);
    }

    // Bulk File Delete
    public function testBulkFileDeleteWhenMissingFileIdsParameter()
    {
        $faker = Faker\Factory::create();

        $options = "";

        $mockBodyResponse = Psr7\stream_for("");

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('DELETE')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $deleteFile = new File();
        $response = $deleteFile->bulkDeleteByFileIds($options, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("FileIds parameter is missing.", $response->err->message);
    }

    public function testBulkFileDeleteWhenSuccessful()
    {
        $faker = Faker\Factory::create();

        $fileIds = [$faker->ean13, $faker->ean13];
        $options = array(
            "fileIds" => $fileIds
        );

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "successfullyDeletedFileIds" => $fileIds,
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('rawPost')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->bulkDeleteByFileIds($options, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals($fileIds[0], $el['successfullyDeletedFileIds'][0]);
    }

    // Update details
    public function testUpdateFileDetailsWhenFileIDTagsAndCustomParameterIsPassed()
    {
        $faker = Faker\Factory::create();

        $the_file_id = "5df36759adf3f523d81dd94f";

        $updateData = array(
            "customCoordinates" => "10,10,100,100",
            "tags" => array("tag1", "tag2")
        );

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            "fileId" => "598821f949c0a938d57563bd",
            "type" => "file",
            "name" => "file1.jpg",
            "filePath" => "/images/products/file1.jpg",
            "tags" => ["t-shirt", "round-neck", "sale2019"],
            "isPrivateFile" => false,
            "customCoordinates" => null,
            "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
            "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
            "fileType" => "image"
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('patch')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $updateDetails = new File();
        $response = $updateDetails->updateFileDetails($the_file_id, $updateData, $stub);

        $el = get_object_vars($response->success);
        $this->assertNull($response->err);
        $this->assertEquals(array(
            "fileId" => "598821f949c0a938d57563bd",
            "type" => "file",
            "name" => "file1.jpg",
            "filePath" => "/images/products/file1.jpg",
            "tags" => ["t-shirt", "round-neck", "sale2019"],
            "isPrivateFile" => false,
            "customCoordinates" => null,
            "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
            "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
            "fileType" => "image"
        ), $el);
    }

    public function testUpdateFileDetailsWhenFileIDParameterIsNotPassed()
    {
        $the_file_id = "";

        $updateData = array(
            "customCoordinates" => "10,10,100,100",
            "tags" => array("tag1", "tag2")
        );

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "fileId" => "598821f949c0a938d57563bd",
                "type" => "file",
                "name" => "file1.jpg",
                "filePath" => "/images/products/file1.jpg",
                "tags" => ["t-shirt", "round-neck", "sale2019"],
                "isPrivateFile" => false,
                "customCoordinates" => null,
                "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
                "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
                "fileType" => "image"
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('patch')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $updateDetails = new File();
        $response = $updateDetails->updateFileDetails($the_file_id, $updateData, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing File ID parameter for this request", $response->err->message);
    }

    public function testUpdateFileDetailsWhenUpdateDataIsNotAnArray()
    {

        $faker = Faker\Factory::create();

        $the_file_id = "5df36759adf3f523d81dd94f";

        $updateData = $faker->streetName;

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "fileId" => "598821f949c0a938d57563bd",
                "type" => "file",
                "name" => "file1.jpg",
                "filePath" => "/images/products/file1.jpg",
                "tags" => ["t-shirt", "round-neck", "sale2019"],
                "isPrivateFile" => false,
                "customCoordinates" => null,
                "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
                "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
                "fileType" => "image"
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('patch')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $updateDetails = new File();
        $response = $updateDetails->updateFileDetails($the_file_id, $updateData, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing file update data for this request", $response->err->message);
    }

    public function testUpdateFileDetailsWhenUpdateDataTagIsInvalid()
    {
        $faker = Faker\Factory::create();

        $the_file_id = "5df36759adf3f523d81dd94f";

        $updateData = array(
            "customCoordinates" => "10,10,100,100",
            "tags" => ""
        );

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "fileId" => "598821f949c0a938d57563bd",
                "type" => "file",
                "name" => "file1.jpg",
                "filePath" => "/images/products/file1.jpg",
                "tags" => null,
                "isPrivateFile" => false,
                "customCoordinates" => null,
                "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
                "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
                "fileType" => "image"
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('patch')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $updateDetails = new File();
        $response = $updateDetails->updateFileDetails($the_file_id, $updateData, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Invalid tags parameter for this request", $response->err->message);
    }

    public function testUpdateFileDetailsWhenUpdateCustomCoordinatesAreInvalid()
    {
        $faker = Faker\Factory::create();

        $the_file_id = "5df36759adf3f523d81dd94f";

        $updateData = array(
            "customCoordinates" => [],
            "tags" => array("tag1", "tag2")
        );

        $mockBodyResponse = Psr7\stream_for(
            json_encode(array(
                "fileId" => "598821f949c0a938d57563bd",
                "type" => "file",
                "name" => "file1.jpg",
                "filePath" => "/images/products/file1.jpg",
                "tags" => null,
                "isPrivateFile" => false,
                "customCoordinates" => null,
                "url" => "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
                "thumbnail" => "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
                "fileType" => "image"
            ))
        );

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('patch')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $updateDetails = new File();
        $response = $updateDetails->updateFileDetails($the_file_id, $updateData, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Invalid customCoordinates parameter for this request", $response->err->message);
    }

    // Purge  Details
    public function testPurgeFileCacheApiWithoutUrlPatrameter()
    {
        $faker = Faker\Factory::create();

        $urlParam = "";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "requestId" => "598821f949c0a938d57563bd",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('post')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApi = new File();
        $response = $purgeCacheApi->purgeFileCacheApi($urlParam, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing URL parameter for this request", $response->err->message);
    }

    public function testPurgeCacheApi()
    {
        $faker = Faker\Factory::create();

        $urlParam = "https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "requestId" => "598821f949c0a938d57563bd",
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('post')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApi = new File();
        $response = $purgeCacheApi->purgeFileCacheApi($urlParam, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals("598821f949c0a938d57563bd", $el['requestId']);
    }

    // Purge  Cache API  Details
    public function testPurgeFileCacheApiStatusWithoutRequestId()
    {
        $faker = Faker\Factory::create();
        $requestId = "";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "status" => "Pending"
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApiStatus = new File();
        $response = $purgeCacheApiStatus->purgeFileCacheApiStatus($requestId, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing Request ID parameter for this request", $response->err->message);
    }

    public function testPurgeFileCacheApiStatus()
    {
        $requestId = "598821f949c0a938d57563bd";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array(
                "status" => "Pending"
            ),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $purgeCacheApiStatus = new File();
        $response = $purgeCacheApiStatus->purgeFileCacheApiStatus($requestId, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals("Pending", $el['status']);
    }

    public function testGetFileMetadataFromRemoteURLApiWhenURLParamIsMissing()
    {
        $url = "";

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array("pHash" => "f06830ca9f1e3e90"),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->getFileMetadataFromRemoteURL($url, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Your request is missing the url query paramater.", $response->err->message);
    }

    public function testGetFileMetadataFromRemoteURLApiWhenSuccessful()
    {
        $faker = Faker\Factory::create();
        $url = $faker->url;
        $phash = $faker->ean13;

        $mockBodyResponse = Psr7\stream_for(json_encode(array(
            array("pHash" => $phash),
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $fileInstance = new File();
        $response = $fileInstance->getFileMetadataFromRemoteURL($url, $stub);

        $el = get_object_vars($response->success[0]);
        $this->assertEquals($phash, $el['pHash']);
    }
}
