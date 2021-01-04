<?php

namespace ImageKit\Tests\ImageKit\Upload;

include_once __DIR__ . '/../../../src/ImageKit/Utils/transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/authorization.php';

use ImageKit\Upload\Upload;
use PHPUnit\Framework\TestCase;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7;


final class UploadTest extends TestCase
{
    public function testFileUploadIfMissingDataUpload()
    {
        
        $uploadOptions = array(
            'file' => "http://lorempixel.com/640/480/",
        );

        $mockBodyResponse = Psr7\stream_for(\json_encode(array(
            "width" => 1000
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $uploadInstance = new Upload();
        $response = $uploadInstance->uploadFileRequest($uploadOptions, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing fileName parameter for upload", $response->err->message);
    }

    public function testFileUploadIfMissingFileParameter()
    {
        

        $uploadOptions = array(
            'fileName' => "7e57d004-2b97-0e7a-b45f-5387367791cd",
        );


        $mockBodyResponse = Psr7\stream_for(\json_encode(array(
            "width" => 1000
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $uploadInstance = new Upload();
        $response = $uploadInstance->uploadFileRequest($uploadOptions, $stub);

        $this->assertNull($response->success);
        $this->assertEquals("Missing file parameter for upload", $response->err->message);
    }

    public function testFileUploadIfMissingDataForUpload()
    {
        

        $uploadOptions =  [];

        $mockBodyResponse = Psr7\stream_for(\json_encode(array(
            "width" => 1000
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $uploadInstance = new Upload();
        $res = $uploadInstance->uploadFileRequest($uploadOptions, $stub);
        $response = json_decode(json_encode($res), true);

        $this->assertNull($response['success']);
        $this->assertEquals("Missing file parameter for upload", $response['err']['message']);
    }

    public function testFileUploadIfSuccessful()
    {
        

        $uploadOptions = array(
            'file' => "http://lorempixel.com/640/480/",
            'fileName' => "7e57d004-2b97-0e7a-b45f-5387367791cd",
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
            'transformationPosition' => "path"
        );

        $mockBodyResponse = Psr7\stream_for(\json_encode(array(
            "width" => 1000
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $uploadInstance = new Upload();
        $res = $uploadInstance->uploadFileRequest($uploadOptions, $stub);
        $response = json_decode(json_encode($res), true);

        $this->assertEquals(array(
            "width" => 1000
        ), $response['success']);
    }

    public function testFileUploadIfSuccessfulWithAllParameters()
    {        

        // parameters
        $file = "http://lorempixel.com/640/480/";
        $fileName = "7e57d004-2b97-0e7a-b45f-5387367791cd";
        $useUniqueFileName = rand(0,1) == 1;
        $tags = array('porro', 'sed', 'magni');
        $folder = 'aut';
        $isPrivateFile = rand(0,1) == 1;
        $customCoordinates = "10,10,100,100";
        $responseFields = "name,tags,customCoordinates,isPrivateFile,metadata";
        $metadata = "7e57d004-2b97-0e7a-b45f-5387367791cd";

        $uploadOptions = array(
            'file' => $file,
            'fileName' => $fileName,
            'useUniqueFileName' => $useUniqueFileName,
            'tags' => $tags,
            'folder' => $folder
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
            'transformationPosition' => "path"
        );

        $mockBodyResponse = Psr7\stream_for(\json_encode(array(
            "name" => $fileName,
            "tags" => $tags,
            "customCoordinates" => $customCoordinates,
            "isPrivateFile" => $isPrivateFile,
            "metadata" =>  $metadata
        )));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $uploadInstance = new Upload();
        $res = $uploadInstance->uploadFileRequest($uploadOptions, $stub);
        $response = json_decode(json_encode($res), true);

        $this->assertEquals(array(
            "name" => $fileName,
            "tags" => $tags,
            "customCoordinates" => $customCoordinates,
            "isPrivateFile" => $isPrivateFile,
            "metadata" => $metadata
        ),  $response['success']);
    }
}
