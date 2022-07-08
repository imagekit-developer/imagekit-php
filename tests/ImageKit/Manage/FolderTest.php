<?php

namespace ImageKit\Tests\ImageKit\Manage;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Utils\Transformation;
use ImageKit\Manage\Folder;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class FolderTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;
    private $mockClient;
    
    /**
     * 
     */
    public function testCreateFolder()
    {
        $folderName = 'new-folder';
        $parentFolderPath = '/';

        $requestBody = [
            'parentFolderPath' => $parentFolderPath,
            'folderName' => $folderName,
        ];

        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->createFolder($requestBody);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/folder/",$requestPath);
        FileTest::assertEquals($stream,json_encode($requestBody));

        // Response Check
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

     /**
     * 
     */
    public function testCreateFolderInvalidRequest()
    {
        $response = $this->client->createFolder();

        FolderTest::assertEquals('Create Folder API accepts an array, null passed',$response->error->message);
    }

    /**
     * 
     */
    public function testCreateFolderWithNonArrayParameter()
    {
        $folderName = 'new-folder';
        $parentFolderPath = '/';

        $requestBody = $folderName;

        $response = $this->client->createFolder($requestBody);

        FolderTest::assertEquals('Create Folder API accepts an array of parameters, non array value passed',$response->error->message);
    }

    /**
     * 
     */
    public function testCreateFolderWithEmptyArrayParameter()
    {
        $requestBody = [];

        $response = $this->client->createFolder($requestBody);

        FolderTest::assertEquals('Create Folder API accepts an array of parameters, empty array passed',$response->error->message);
    }
   

    public function testCreateFolderWithMissingFolderName()
    {
        $folderName = '';
        $parentFolderPath = '/';

        $requestBody = [
            'folderName' => $folderName,
            'parentFolderPath' => $parentFolderPath,
        ];

        $response = $this->client->createFolder($requestBody);

        FolderTest::assertEquals('Missing parameter folderName and/or parentFolderPath for Create Folder API', $response->error->message);
    }

    public function testCreateFolderWithMissingParentFolderPath()
    {
        $folderName = 'new-folder';
        $parentFolderPath = '';
        
        $requestBody = [
            'folderName' => $folderName,
            'parentFolderPath' => $parentFolderPath,
        ];

        $response = $this->client->createFolder($requestBody);

        FolderTest::assertEquals('Missing parameter folderName and/or parentFolderPath for Create Folder API', $response->error->message);
    }
    
    /**
     * 
     */
    public function testDeleteFolder()
    {
        $folderPath = '/new-folder';

        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->deleteFolder($folderPath);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/folder/",$requestPath);
        FileTest::assertEquals($stream['folderPath'],$folderPath);

        // Response Check
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'DELETE');
    }
    
    /**
     * 
     */
    public function testDeleteFolderMissingFolderPath()
    {
        $folderPath = '';

        $response = $this->client->deleteFolder($folderPath);

        FolderTest::assertEquals('Missing folderPath for Delete Folder API',$response->error->message);
    }

    public function testCopyFolder(){
        
        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";
        $includeFileVersions = false;

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
            'includeFileVersions' => $includeFileVersions
        ];
        
        $responseBody = [
            "jobId" => "598821f949c0a938d57563bd"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->copyFolder($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/bulkJobs/copyFolder",$requestPath);
        FileTest::assertEquals($stream,json_encode($requestBody));

        // Response Check
        FolderTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    
    public function testCopyFolderWithoutIncludeFileVersions(){
        
        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
        ];
        
        $responseBody = [
            "jobId" => "598821f949c0a938d57563bd"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->copyFolder($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/bulkJobs/copyFolder",$requestPath);
        FileTest::assertEquals($stream,json_encode([
            'sourceFolderPath' => '/source-folder/',
            'destinationPath' => '/destination-folder/',
            'includeFileVersions' => false
        ]));

        // Response Check
        FolderTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    
    public function testCopyFolderInvalidRequest(){

        $response = $this->client->copyFolder();

        FolderTest::assertEquals("Copy Folder API accepts an array, null passed", $response->error->message);

    }
    
    public function testCopyFolderNonArray(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";
        $includeVersions = false;

        $requestBody = $sourceFolderPath;
        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals("Copy Folder API accepts an array of parameters, non array value passed", $response->error->message);

    }

    public function testCopyFolderEmptyArray(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";
        $includeVersions = false;

        $requestBody = [];
        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals("Copy Folder API accepts an array of parameters, empty array passed", $response->error->message);

    }

    public function testCopyFolderWithMissingSourceFolderPath(){

        $sourceFolderPath = "";
        $destinationPath = "/destination-folder/";
        $includeVersions = false;

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];
        
        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath for Copy Folder API", $response->error->message);

    }

    public function testCopyFolderWithMissingDestinationPath(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "";
        $includeVersions = false;

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];
        
        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath for Copy Folder API", $response->error->message);

    }

    public function testCopyFolderWithNullIncludeVersions(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";
        $includeVersions = null;

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];
        
        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->copyFolder($requestBody);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/bulkJobs/copyFolder",$requestPath);
        FileTest::assertEquals($stream,json_encode([
            'sourceFolderPath' => '/source-folder/',
            'destinationPath' => '/destination-folder/',
            'includeFileVersions' => false
        ]));

        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    
    public function testMoveFolder(){
        
        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
        ];
        
        $responseBody = [
            "jobId" => "598821f949c0a938d57563bd"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->moveFolder($requestBody);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/bulkJobs/moveFolder",$requestPath);
        FileTest::assertEquals($stream,json_encode($requestBody));

        // Response Check
        FolderTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    
    public function testMoveFolderInvalidRequest(){

        $response = $this->client->moveFolder();

        FolderTest::assertEquals("Move Folder API accepts an array, null passed", $response->error->message);

    }
    
    public function testMoveFolderNonArray(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";

        $requestBody = $sourceFolderPath;
        $response = $this->client->moveFolder($requestBody);

        FolderTest::assertEquals("Move Folder API accepts an array of parameters, non array value passed", $response->error->message);

    }

    public function testMoveFolderEmptyArray(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "/destination-folder/";

        $requestBody = [];
        $response = $this->client->moveFolder($requestBody);

        FolderTest::assertEquals("Move Folder API accepts an array of parameters, empty array passed", $response->error->message);

    }

    public function testMoveFolderWithMissingSourceFolderPath(){

        $sourceFolderPath = "";
        $destinationPath = "/destination-folder/";

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
        ];
        
        $response = $this->client->moveFolder($requestBody);

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath for Move Folder API", $response->error->message);

    }

    public function testMoveFolderWithMissingDestinationPath(){

        $sourceFolderPath = "/source-folder/";
        $destinationPath = "";

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
        ];
        
        $response = $this->client->moveFolder($requestBody);

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath for Move Folder API", $response->error->message);

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

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );
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

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
