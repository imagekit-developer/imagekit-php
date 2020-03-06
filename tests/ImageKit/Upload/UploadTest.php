<?php

namespace ImageKit\Tests\ImageKit\Upload;

include_once __DIR__ . '/../../../src/ImageKit/Utils/transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/authorization.php';

use ImageKit\Upload\Upload;
use PHPUnit\Framework\TestCase;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7;
use Faker;

final class UploadTest extends TestCase
{
    public function testFileUploadIfMissingDataUpload()
    {
        $faker = Faker\Factory::create();

        $uploadOptions = array(
            'file' => $faker->imageUrl($width = 640, $height = 480),
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
        $faker = Faker\Factory::create();

        $uploadOptions = array(
            'fileName' => $faker->uuid,
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
        $faker = Faker\Factory::create();

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
        $faker = Faker\Factory::create();

        $uploadOptions = array(
            'file' => $faker->imageUrl($width = 640, $height = 480),
            'fileName' => $faker->uuid,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
            'transformationPosition' => $faker->word
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
        $faker = Faker\Factory::create();

        // parameters
        $file = $faker->imageUrl($width = 640, $height = 480);
        $fileName = $faker->uuid;
        $useUniqueFileName = $faker->boolean($chanceOfGettingTrue = 50);
        $tags = $faker->words($nb = 3, $asText = false);
        $folder = $faker->word;
        $isPrivateFile = $faker->boolean($chanceOfGettingTrue = 50);
        $customCoordinates = "10,10,100,100";
        $responseFields = "name,tags,customCoordinates,isPrivateFile,metadata";
        $metadata = $faker->uuid;

        $uploadOptions = array(
            'file' => $file,
            'fileName' => $fileName,
            'useUniqueFileName' => $useUniqueFileName,
            'tags' => $tags,
            'folder' => $folder
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
            'transformationPosition' => $faker->word
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
