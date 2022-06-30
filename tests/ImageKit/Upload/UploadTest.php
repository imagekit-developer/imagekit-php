<?php

namespace ImageKit\Tests\ImageKit\Upload;

include_once __DIR__ . '/../../../src/ImageKit/Utils/Transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/Authorization.php';

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;
use function json_encode;


/**
 *
 */
final class UploadTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    private $uploadSuccessResponseObj = [
        "fileId"=> "598821f949c0a938d57563bd",
        "name"=> "file1.jpg",
        "url"=> "https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg",
        "thumbnailUrl"=> "https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg",
        "height"=> 300,
        "width"=> 200,
        "size"=> 83622,
        "filePath"=> "/images/products/file1.jpg",
        "tags"=> ["t-shirt", "round-neck", "sale2019"],
        "isPrivateFile"=> false,
        "customCoordinates"=> null,
        "fileType"=> "image",
        "AITags"=>[["name"=>"Face","confidence"=>99.95,"source"=>"aws-auto-tagging"]],
        "extensionStatus"=>["aws-auto-tagging"=>"success"]
    ];

    /**
     *
     */
    private function stubHttpClient($response)
    {
        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('postMultipart')->willReturn($response);

        $closure = function () use ($stub) {
            $this->httpClient = $stub;
        };
        $doClosure = $closure->bindTo($this->client, ImageKit::class);
        $doClosure();
    }


    /**
     *
     */
    public function testFileUploadIfInvalidUploadParams()
    {

        $mockBodyResponse = Utils::streamFor();

        $response = $this->client->uploadFile(null);

        // echo json_encode($response->error);
        UploadTest::assertNull($response->result);
        UploadTest::assertEquals('Upload API accepts an array of parameters, null passed', $response->error->message);
    }

    /**
     *
     */
    public function testFileUploadIfMissingFileName()
    {
        
        $fileOptions = [
            'file' => 'http://lorempixel.com/640/480/',
        ];

        $response = $this->client->uploadFile($fileOptions);

        // echo json_encode($response->error);
        UploadTest::assertNull($response->result);
        UploadTest::assertEquals('Missing fileName parameter for upload', $response->error->message);
    }

    /**
     *
     */
    public function testFileUploadIfMissingFile()
    {        
        $fileOptions = [
            'fileName' => 'default-image.png',
        ];

        $response = $this->client->uploadFile($fileOptions);

        // echo json_encode($response->error);
        UploadTest::assertNull($response->result);
        UploadTest::assertEquals('Missing file parameter for upload', $response->error->message);
    }

    
    /**
     *
     */
    public function testFileUploadIfSuccessful()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => false,                                        // true|false
            "tags" => implode(',',["abd", "def"]),                              // Comma Separated, Max length: 500 chars
            "folder" => "/sample-folder",                                          // Using multiple forward slash (/) creates a nested folder
            "isPrivateFile" => true,                                           // true|false
            "customCoordinates" => implode(",", ["10", "10", "100", "100"]),    // Comma Separated, Max length: 500 chars
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            "extensions" => [                                                  // An array of extensions, for more extensions refer to docs
                [
                    "name" => "remove-bg",
                    "options" => [  // all parameters inside this object are sent directly to the third-party service
                        "add_shadow" => true
                    ]
                ]
            ],
            "webhookUrl" => "https://example.com/webhook",                      // Notification URL to receive the final status of pending extensions
            "overwriteFile" => true,                                            // true|false, in case of false useUniqueFileName should be true
            "overwriteAITags" => false,                                          // true|false, set to false in order to preserve overwriteAITags
            "overwriteTags" => false,                                            // true|false
            "overwriteCustomMetadata" => true,                                  // true|false
            "customMetadata" => [                                              // An array of created custom fields, for more details refer to docs
                    "SKU" => "VS882HJ2JD",
                    "price" => 599.99,
            ]
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($this->uploadSuccessResponseObj));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertArrayHasKey('file',$fileOptions);
        UploadTest::assertArrayHasKey('fileName',$fileOptions);
        UploadTest::assertIsString($fileOptions['tags']);
        UploadTest::assertArrayHasKey('useUniqueFileName',$fileOptions);
        UploadTest::assertIsBool($fileOptions['useUniqueFileName']);
        UploadTest::assertIsBool($fileOptions['isPrivateFile']);
        UploadTest::assertIsString($fileOptions['responseFields']);
        UploadTest::assertIsArray($fileOptions['extensions']);
        UploadTest::assertIsBool($fileOptions['overwriteFile']);
        UploadTest::assertIsBool($fileOptions['overwriteAITags']);
        UploadTest::assertIsBool($fileOptions['overwriteTags']);
        UploadTest::assertIsBool($fileOptions['overwriteCustomMetadata']);
        UploadTest::assertIsArray($fileOptions['customMetadata']);

        // Response Check
        UploadTest::assertEquals(json_encode($this->uploadSuccessResponseObj), json_encode($response->result));
    }

    /**
     *
     */
    public function testFileUploadMissingUseUniqueFileName()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            'isPrivateFile' => true
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->uploadFile($fileOptions);

        // Request Check
        UploadTest::assertArrayHasKey('file',$fileOptions);
        UploadTest::assertArrayHasKey('fileName',$fileOptions);
        UploadTest::assertIsBool($fileOptions['isPrivateFile']);

        // Response Check
        UploadTest::assertArrayNotHasKey('useUniqueFileName', (array) $response->result);
    }

    /**
     *
     */
    public function testFileUploadMissingIsPrivateFileUseUniqueFileName()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "tags" => implode(",",["abd", "def"]),
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertArrayHasKey('file',$fileOptions);
        UploadTest::assertArrayHasKey('fileName',$fileOptions);
        UploadTest::assertIsString($fileOptions['tags']);

        // Response Check
        UploadTest::assertArrayNotHasKey('isPrivateFile', (array) $response->result);
        UploadTest::assertArrayNotHasKey('useUniqueFileName', (array) $response->result);
    }


    /**
     *
     */
    public function testFileUploadBareMinimumRequest()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->uploadFile($fileOptions);

        
        // Request Body Check
        UploadTest::assertArrayHasKey('file',$fileOptions);
        UploadTest::assertArrayHasKey('fileName',$fileOptions);

        // Response Check
        UploadTest::assertArrayNotHasKey('tags', (array) $response->result);
        UploadTest::assertArrayNotHasKey('useUniqueFileName', (array) $response->result);
        UploadTest::assertArrayNotHasKey('isPrivateFile', (array) $response->result);
        UploadTest::assertArrayNotHasKey('customCoordinates', (array) $response->result);
        UploadTest::assertArrayNotHasKey('responseFields', (array) $response->result);
    }
    
    /**
     *
     */
    public function testServerSideError()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
        ];

        $error = [
            "help" => "For support kindly contact us at support@imagekit.io .",
            "message" => "Your account cannot be authenticated."
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }
    
    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

    }

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
