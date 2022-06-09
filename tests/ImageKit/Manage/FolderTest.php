<?php

namespace ImageKit\Tests\ImageKit\Manage;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Manage\Folder;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

class FolderTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     * 
     */
    public function testCreateFolder()
    {
        $folderName = 'new-folder';
        $parentFolderPath = '/';

        $requestBody = [
            'folderName' => $folderName,
            'parentFolderPath' => $parentFolderPath,
        ];

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->createFolder($requestBody);

        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
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

        $this->stubHttpClient('delete', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteFolder($folderPath);
        
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
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
        $includeVersions = false;

        $requestBody = [
            'sourceFolderPath' => $sourceFolderPath,
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];
        
        $responseBody = [
            "jobId" => "598821f949c0a938d57563bd"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('post', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals(json_encode($responseBody), json_encode($response->result));
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

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath and/or includeVersions for Copy Folder API", $response->error->message);

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

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath and/or includeVersions for Copy Folder API", $response->error->message);

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
        
        $response = $this->client->copyFolder($requestBody);

        FolderTest::assertEquals("Missing parameter sourceFolderPath and/or destinationPath and/or includeVersions for Copy Folder API", $response->error->message);

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

        $this->stubHttpClient('post', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFolder($requestBody);

        FolderTest::assertEquals(json_encode($responseBody), json_encode($response->result));
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

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
