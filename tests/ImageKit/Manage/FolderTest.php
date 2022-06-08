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
    }

    public function testCopyEmptySource()
    {
        $sourceFolderPath = '';
        $destinationPath = '/testing2';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFolder($sourceFolderPath, $destinationPath);

        FolderTest::assertEquals('Missing data for copying folder', $response->error);
    }

    public function testCopyEmptyDestinationPath()
    {
        $sourceFolderPath = '/';
        $destinationPath = '';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFolder($sourceFolderPath, $destinationPath);

        FolderTest::assertEquals('Missing data for copying folder', $response->error);
    }

    public function testCopy()
    {
        $sourceFolderPath = '/testing';
        $destinationPath = '/testing2';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFolder([
            'sourceFolderPath' => $sourceFolderPath, 
            'destinationPath'  => $destinationPath,
            'includeVersions'  => false
        ]);

        $el = get_object_vars($response->result);
        FolderTest::assertEquals('Testing_job_id', $el['jobId']);
    }

    public function testMoveEmptySource()
    {
        $sourceFolderPath = '';
        $destinationPath = '/testing2';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFolder($sourceFolderPath, $destinationPath);

        FolderTest::assertEquals('Missing data for moving folder', $response->error);
    }

    public function testMoveEmptyDestinationPath()
    {
        $sourceFolderPath = '/';
        $destinationPath = '';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFolder($sourceFolderPath, $destinationPath);

        FolderTest::assertEquals('Missing data for moving folder', $response->error);
    }

    public function testMove()
    {
        $sourceFolderPath = '/testing';
        $destinationPath = '/testing2';

        $mockBodyResponse = Utils::streamFor(json_encode([ 'jobId' => 'Testing_job_id' ]));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFolder([
            'sourceFolderPath' => $sourceFolderPath, 
            'destinationPath' => $destinationPath,
            'includeVersions' => true
        ]);

        $el = get_object_vars($response->result);
        FolderTest::assertEquals('Testing_job_id', $el['jobId']);
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
