<?php

namespace ImageKit\Tests\ImageKit\Upload;

include_once __DIR__ . '/../../../src/ImageKit/Utils/Transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/Authorization.php';

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Utils\Transformation;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

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
    private $mockClient;

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
    private function createMockClient($handler){
        $this->mockClient = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo',
            Transformation::DEFAULT_TRANSFORMATION_POSITION,
            $handler
        );
    }
     
    private function checkFormData($requestBody, $boundary, $fieldName, $fieldValue) {
        
        $string = '--'.$boundary.' Content-Disposition: form-data; name="'.$fieldName.'" Content-Length: '.strlen($fieldValue).'  '.$fieldValue;
        $string = substr(json_encode($string),1,-1);

        UploadTest::assertContains($string,$requestBody);
    }

    /**
     *
     */
    public function testFileUploadIfInvalidUploadParams()
    {

        $mockBodyResponse = Utils::streamFor();

        $response = $this->client->uploadFile(null);

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
            ],
            'transformation' => [ 
                'pre' => 'l-text,i-Imagekit,fs-50,l-end', 
                'post' => [
                    [ 
                        'type' => 'transformation', 
                        'value' => 'h-100' 
                    ]
                ]
            ],
            'checks' => "'request.folder' : '/sample-folder'"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($this->uploadSuccessResponseObj));


        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);
        
        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"tags",implode(',',["abd", "def"]));
        $this->checkFormData($stream,$boundary,"isPrivateFile","true");
        $this->checkFormData($stream,$boundary,"useUniqueFileName","false");
        $this->checkFormData($stream,$boundary,"responseFields",implode(",", ["tags", "customMetadata"]));
        $this->checkFormData($stream,$boundary,"extensions",json_encode($fileOptions['extensions']));
        $this->checkFormData($stream,$boundary,"webhookUrl","https://example.com/webhook");
        $this->checkFormData($stream,$boundary,"overwriteFile","true");
        $this->checkFormData($stream,$boundary,"overwriteAITags","false");
        $this->checkFormData($stream,$boundary,"overwriteCustomMetadata","true");
        $this->checkFormData($stream,$boundary,"customMetadata",json_encode($fileOptions['customMetadata']));
        $this->checkFormData($stream,$boundary,"transformation",json_encode($fileOptions['transformation']));
        $this->checkFormData($stream,$boundary,"checks",$fileOptions['checks']);

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');
        
        // Response Check
        UploadTest::assertEquals(json_encode($this->uploadSuccessResponseObj), json_encode($response->result));
    }

    /**
     *
     */
    public function testFileUploadWithOnlyPreTransformationIfSuccessful()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [ 
                'pre' => 'l-text,i-Imagekit,fs-50,l-end', 
            ],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($this->uploadSuccessResponseObj));


        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);
        
        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"useUniqueFileName","true");
        $this->checkFormData($stream,$boundary,"responseFields",implode(",", ["tags", "customMetadata"]));
        $this->checkFormData($stream,$boundary,"transformation",json_encode($fileOptions['transformation']));

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');
        
        // Response Check
        UploadTest::assertEquals(json_encode($this->uploadSuccessResponseObj), json_encode($response->result));
    }

    /**
     *
     */
    public function testFileUploadWithOnlyPostTransformationIfSuccessful()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [ 
                'post' => [
                    [ 
                        'type' => 'transformation', 
                        'value' => 'h-100' 
                    ]
                ]
            ],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($this->uploadSuccessResponseObj));


        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);
        
        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"useUniqueFileName","true");
        $this->checkFormData($stream,$boundary,"responseFields",implode(",", ["tags", "customMetadata"]));
        $this->checkFormData($stream,$boundary,"transformation",json_encode($fileOptions['transformation']));

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');
        
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

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);
        
        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"isPrivateFile","true");
        UploadTest::assertNotContains("useUniqueFileName",$stream);

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
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

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);

        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);

        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"tags","abd,def");
        UploadTest::assertNotContains("isPrivateFile",$stream);
        UploadTest::assertNotContains("useUniqueFileName",$stream);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
    }

    /**
     *
     */
    public function testFileUploadTagsAsArray()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "tags" => ["abd", "def"],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);

        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"tags","abd,def");

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
    }

    /**
     *
     */
    public function testFileUploadCustomCoordinatesAsArray()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "customCoordinates" => ["10", "10", "100", "100"],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);

        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"customCoordinates","10,10,100,100");
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
    }

    
    /**
     * 
     */
    public function testFileUploadResponseFieldsAsArray()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "responseFields" => ["tags", "customMetadata"],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);

        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        $this->checkFormData($stream,$boundary,"responseFields","tags,customMetadata");
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
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

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->uploadFile($fileOptions);

        $requestBody = $container[0]['request']->getBody();
        $requestHeaders = $container[0]['request']->getHeaders();
        $boundary = str_replace("multipart/form-data; boundary=","",$requestHeaders["Content-Type"][0]);

        UploadTest::assertArrayHasKey("Content-Type",$requestHeaders);
        UploadTest::assertStringStartsWith("multipart/form-data; boundary=",$requestHeaders['Content-Type'][0]);

        $stream = Utils::streamFor($requestBody);
        $stream = str_replace('\r\n',' ',json_encode($stream->getContents()));

        $this->checkFormData($stream,$boundary,"file",$fileOptions['file']);
        $this->checkFormData($stream,$boundary,"fileName",$fileOptions['fileName']);
        UploadTest::assertNotContains("tags",$stream);
        UploadTest::assertNotContains("isPrivateFile",$stream);
        UploadTest::assertNotContains("useUniqueFileName",$stream);
        UploadTest::assertNotContains("customCoordinates",$stream);
        UploadTest::assertNotContains("responseFields",$stream);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        UploadTest::assertEquals($requestMethod,'POST');        
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

    /**
     *
     */
    public function testFileUploadWithInvalidTransformation()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [],
        ];

        $error = [
            "message" => "Invalid transformation parameter. Please include at least pre, post, or both.",
            "help" => "For support kindly contact us at support@imagekit.io ."
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }

    /**
     *
     */
    public function testFileUploadWithInvalidPreTransformation()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [ 
                'pre' => '',
            ],
        ];

        $error = [
            "message" => "Invalid pre transformation parameter.",
            "help" => "For support kindly contact us at support@imagekit.io ."
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }
    
    /**
     *
    */
    public function testFileUploadWithInvalidAbsTypePostTransformation()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [ 
                'post' => [
                    [ 
                        'type' => 'abs', 
                        'value' => '' 
                    ]
                ]
            ],
        ];

        $error = [
            "message" => "Invalid post transformation parameter.",
            "help" => "For support kindly contact us at support@imagekit.io ."
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }

    /**
     *
    */
    public function testFileUploadWithInvalidTransformationTypePostTransformation()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'transformation' => [ 
                'post' => [
                    [ 
                        'type' => 'transformation', 
                        'value' => '' 
                    ]
                ]
            ],
        ];

        $error = [
            "message" => "Invalid post transformation parameter.",
            "help" => "For support kindly contact us at support@imagekit.io ."
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($fileOptions));

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }


    /**
     *
    */
    public function testFileUploadWithInvalidChecks()
    {
        $fileOptions = [
            'file'  =>  'http://lorempixel.com/640/480/',
            'fileName'  =>  'test_file_name',
            "useUniqueFileName" => true,                                        // true|false
            "responseFields" => implode(",", ["tags", "customMetadata"]),       // Comma Separated, check docs for more responseFields
            'checks' => true
        ];

        $error = [
            "message" => "The value provided for the checks parameter is invalid.",
            "help" => "For support kindly contact us at support@imagekit.io ."
        ];

        $this->stubHttpClient(new Response(403, ['X-Foo' => 'Bar'], json_encode($error)));

        $response = $this->client->uploadFile($fileOptions);

        // Request Body Check
        UploadTest::assertEquals(json_encode($error),json_encode($response->error));
    }
    
    protected function setUp()
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

    }

    protected function tearDown()
    {
        $this->client = null;
    }
}
