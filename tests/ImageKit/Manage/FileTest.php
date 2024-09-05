<?php

namespace ImageKit\Tests\ImageKit\Manage;


use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Utils\Transformation;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

/**
 *
 */
final class FileTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;
    private $mockClient;

    private $dummyAPIErrorResponse = [
        "help" => "help",
        "message" => "message"
    ];

        /**
     *
     */
    public function testListFiles()
    {
        $responseBody = [
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => ["tag1","tag2"],
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
            ],
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->listFiles();

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    /**
     *
     */
    public function testListFilesWithOptions()
    {
        $listOptions = [
            "type" => "file",
            "sort" => "ASC_CREATED",    
            "path" => "/sample-folder",
            "fileType" => "all",
            "limit" => 10,
            "skip" => 0,
            "tags" => ["tag3","tag4"],
        ];

        $responseBody = [
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

        $response = $this->mockClient->listFiles($listOptions);

        $request = $container[0]['request'];
        $queryString = $request->getUri()->getQuery();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();

        FileTest::assertEmpty($stream);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }
      

    
    /**
     *
     */
    public function testListFilesWithEmptyOptions()
    {
        $listOptions = [];

        $responseBody = [
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

        $response = $this->mockClient->listFiles($listOptions);

        $request = $container[0]['request'];
        $queryString = $request->getUri()->getQuery();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();

        FileTest::assertEmpty($queryString);
        FileTest::assertEmpty($stream);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }
      
    /**
     *
     */
    public function testListFilesWithInvalidOptions()
    {
        $listOptions = 'invalid';

        $response = $this->client->listFiles($listOptions);

        FileTest::assertEquals('List File Options accepts an array of parameters, non array value passed', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileDetails()
    {
        $fileId = '23902390239203923';
       
        $responseBody = [
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
        
        $response = $this->mockClient->getFileDetails($fileId);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();

        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/details",$requestPath);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }

    /**
     *
     */
    public function testGetFileDetailsWithMissingFileId()
    {
        $fileId = '';
       
        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileDetails($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }

    /**
     *
     */
    public function testGetFileDetailsWithError()
    {
        $fileId = '23902390239203923';
       
        $this->stubHttpClient('get', new Response(500, ['X-Foo' => 'Bar'], json_encode($this->dummyAPIErrorResponse)));

        $response = $this->client->getFileDetails($fileId);

        FileTest::assertEquals(json_encode($this->dummyAPIErrorResponse),json_encode($response->error));
    }
    
    /**
     *
     */
    public function testGetFileVersionDetails()
    {
        $fileId = '23902390239203923';
        $versionId = '23902390239203923';
       
        $responseBody = [
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
            "versionInfo" => [
                "id" => "598821f949c0a938d57563bd",
                "name" => "Version 1"
            ],
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
        
        $response = $this->mockClient->getFileVersionDetails($fileId, $versionId);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        
        
        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/versions/{$versionId}",$requestPath);
        
        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
                
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }

    /**
     *
     */
    public function testGetFileVersionDetailsWithMissingFileId()
    {
        $fileId = '';
        $versionId = '23902390239203923';
       
        $response = $this->client->getFileVersionDetails($fileId, $versionId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileVersionDetailsWithMissingVersionId()
    {
        $fileId = '23902390239203923';
        $versionId = '';
       
        $response = $this->client->getFileVersionDetails($fileId, $versionId);

        FileTest::assertEquals('Missing Version ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileVersions()
    {
        $fileId = '23902390239203923';
       
        $responseBody = [
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
                "versionInfo" => [
                    "id" => "598821f949c0a938d57563bd",
                    "name" => "Version 1"
                ]
            ],
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
                "versionInfo" => [
                    "id" => "330a81i1f949c0a938d57563bd",
                    "name" => "Version 2"
                ]
            ],
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

        $response = $this->mockClient->getFileVersions($fileId);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        
        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/versions",$requestPath);
        
        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
                
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }

    
    /**
     *
     */
    public function testGetFileVersionsWithMissingFileId()
    {
        $fileId = '';
       
        $response = $this->client->getFileVersions($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    
    /**
     *
     */
    public function testUpdateFileDetails()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2'],
            'removeAITags'=>['car','vehicle','motorsports'],
            'extensions'=>[
                [
                    "name" => "google-auto-tagging",
                    "maxTags" => 5,
                    "minConfidence" => 95
                ]
            ],
            "customMetadata" => [
                "SKU" => "VS882HJ2JD",
                "price" => 599.99,
            ]
        ];

        $responseBody = [
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

        $response = $this->mockClient->updateFileDetails($fileId, $updateData);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        
        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/details",$requestPath);
        FileTest::assertEquals($stream,json_encode($updateData));

        // Response Check        
        FileTest::assertNull($response->error);
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
                
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PATCH');
    }

        /**
     *
     */
    public function testUpdateFilePublishStatus()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            "publish" => [
                "isPublished" => true,
                "includeFileVersions" => true
            ]
        ];

        $responseBody = [
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'isPublished' => true,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
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

        $response = $this->mockClient->updateFileDetails($fileId, $updateData);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        
        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/details",$requestPath);
        FileTest::assertEquals($stream,json_encode($updateData));

        // Response Check        
        FileTest::assertNull($response->error);
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
                
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PATCH');
    }
    
    public function testUpdateFileDetailsWithInvalidTags()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => 'tag1,tag2',
            'removeAITags'=>['car','vehicle','motorsports'],
            'extensions'=>[
                [
                    "name" => "google-auto-tagging",
                    "maxTags" => 5,
                    "minConfidence" => 95
                ]
            ],
            "customMetadata" => [
                "SKU" => "VS882HJ2JD",
                "price" => 599.99,
            ]
        ];

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Invalid tags parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testUpdateFileDetailsWithMissingFileId()
    {
        $fileId = '';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    
    /**
     *
     */
    public function testUpdateFileDetailsWithInvalidUpdateData()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [];

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing file update data for this request', $response->error->message);
    }

    
    /**
     *
     */
    public function testUpdateFileDetailsWithError()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $this->stubHttpClient('patch', new Response(500, ['X-Foo' => 'Bar'], json_encode($this->dummyAPIErrorResponse)));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertEquals(json_encode($this->dummyAPIErrorResponse),json_encode($response->error));
    }
    

    /**
     *
     */
    public function testBulkAddTags()
    {
        $fileIds = ['5e21880d5efe355febd4bccd','5e1c13c1c55ec3437c451403'];
        $tags = ['testing_tag1'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
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
        
        $response = $this->mockClient->bulkAddTags($fileIds, $tags);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals($stream['fileIds'],$fileIds);
        FileTest::assertEquals($stream['tags'],$tags);
        FileTest::assertEquals("/v1/files/addTags",$requestPath);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
                
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }
    
    
    /**
     *
     */
    public function testBulkAddTagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    

    /**
     *
     */
    public function testBulkAddTagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }

     /**
     *
     */
    public function testBulkAddTagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkAddTagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testBulkRemoveTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = ['testing_tag1'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "23902390239203923",
            ]
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

        $response = $this->mockClient->bulkRemoveTags($fileIds, $tags);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals($stream['fileIds'],$fileIds);
        FileTest::assertEquals($stream['tags'],$tags);
        FileTest::assertEquals("/v1/files/removeTags",$requestPath);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }
        
     
    /**
     *
     */
    public function testBulkRemoveTagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testBulkRemoveAITags()
    {
        $fileIds = ['5e21880d5efe355febd4bccd','5e1c13c1c55ec3437c451403'];
        $AItags = ['image_AITag_1','image_AITag_2'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
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

        $response = $this->mockClient->bulkRemoveAITags($fileIds, $AItags);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals($stream['fileIds'],$fileIds);
        FileTest::assertEquals($stream['AITags'],$AItags);
        FileTest::assertEquals("/v1/files/removeAITags",$requestPath);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['image_AITag_1'];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }
        
     
    /**
     *
     */
    public function testBulkRemoveAITagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testDeleteSingleFile()
    {
        $fileId = "23902390239203923";

        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->deleteFile($fileId);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/".$fileId,$requestPath);
        FileTest::assertEquals($stream[0],$fileId);

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
    public function testDeleteSingleFileMissingFileId()
    {
        $fileId = "";

        $response = $this->client->deleteFile($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testDeleteFileVersion()
    {
        $fileId = '23902390239203923';
        $versionId = "123213239023902392";
        
        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);
        
        $response = $this->mockClient->deleteFileVersion($fileId, $versionId);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/versions/{$versionId}",$requestPath);
        FileTest::assertEquals($stream[0],$fileId);
        FileTest::assertEquals($stream[1],$versionId);

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
    public function testDeleteFileVersionWithMissingFileId()
    {
        $fileId = "";
        $versionId = "version_id";

        $response = $this->client->deleteFileVersion($fileId, $versionId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testDeleteFileVersionWithMissingVisionId()
    {
        $fileId = "file_id";
        $versionId = "";

        $response = $this->client->deleteFileVersion($fileId, $versionId);

        FileTest::assertEquals('Missing Version ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFiles()
    {
        $fileIds = ['file_id1','file_id2'];
        
        $responseBody = [
            "successfullyDeletedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
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

        $response = $this->mockClient->bulkDeleteFiles($fileIds);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $requestBody = $request->getBody();
        $stream = Utils::streamFor($requestBody)->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/batch/deleteByFileIds",$requestPath);
        FileTest::assertEquals($stream['fileIds'],$fileIds);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    /**
     *
     */
    public function testBulkDeleteFilesInvalidRequest()
    {   
        $response = $this->client->bulkDeleteFiles();

        FileTest::assertEquals('Missing Parameter FileIds', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFilesMissingFileIds()
    {   
        $fileIds = [];
        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertEquals('File ids should be passed as an array of file ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFilesNonArrayFileIds()
    {   
        $fileIds = 'file_id';
        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertEquals('File ids should be passed in an array', $response->error->message);
    }
    
    /**
     *
     */
    public function testCopyFile()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeFileVersions = true;

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath,
            'includeFileVersions' => $includeFileVersions
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

        $response = $this->mockClient->copy($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        // $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/copy",$requestPath);
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
    public function testCopyFileWithoutIncludeFileVersions()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeFileVersions = true;

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath,
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

        $response = $this->mockClient->copy($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        // $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/copy",$requestPath);
        FileTest::assertEquals($stream,json_encode([
            'sourceFilePath' => '/file.jpg',
            'destinationPath' => '/',
            'includeFileVersions' => false
        ]));

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
    public function testCopyFileInvalidParameter()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [];

        $response = $this->client->copy($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Copy File API accepts an array of parameters, empty array passed',$response->error->message);

    }
    

    /**
     *
     */
    public function testCopyFileMissingSourceFilePath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];

        $response = $this->client->copy($requestBody);

        
        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Copy File API',$response->error->message);
    }
    
    /**
     *
     */
    public function testCopyFileMissingDestinationPath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'includeVersions' => $includeVersions
        ];

        $response = $this->client->copy($requestBody);

        
        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Copy File API',$response->error->message);

    }
    
    /**
     *
     */
    public function testMoveFile()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath
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

        $response = $this->mockClient->move($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/files/move",$requestPath);
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
    public function testMoveFileInvalidParameter()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [];

        $response = $this->client->move($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Move File API accepts an array of parameters, empty array passed',$response->error->message);
    }

    /**
     *
     */
    public function testMoveFileMissingSourceFilePath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'destinationPath' => $destinationPath,
        ];

        $response = $this->client->move($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Move File API',$response->error->message);
    }

    /**
     *
     */
    public function testMoveFileMissingDestinationPath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
        ];

        $response = $this->client->move($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Move File API',$response->error->message);

    }

     /**
     *
     */
    public function testRenameFile()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = 'sample-file2.jpg';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
            'purgeCache' => true
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

        $response = $this->mockClient->rename($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/files/rename",$requestPath);
        FileTest::assertEquals($stream,json_encode($requestBody));

        // Response Check
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PUT');
    }

    
     /**
     *
     */
    public function testRenameFileWithoutPurgeCache()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = 'sample-file2.jpg';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
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

        $response = $this->mockClient->rename($requestBody);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();

        // Request Check
        FileTest::assertEquals("/v1/files/rename",$requestPath);
        FileTest::assertEquals($stream,json_encode([
            'filePath' => '/sample-folder/sample-file.jpg',
            'newFileName' => 'sample-file2.jpg',
            'purgeCache' => false
        ]));

        // Response Check
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PUT');
    }

     /**
     *
     */
    public function testRenameFileWithInvalidRequest()
    {
        $response = $this->client->rename();

        FileTest::assertEquals('Rename File API accepts an array, null passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithNonArrayParameter()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = 'sample-file2.jpg';

        $requestBody = $filePath;

        $response = $this->client->rename($requestBody);

        FileTest::assertEquals('Rename File API accepts an array of parameters, non array value passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithEmptyArrayParameter()
    {
        $requestBody = [];

        $response = $this->client->rename($requestBody);

        FileTest::assertEquals('Rename File API accepts an array of parameters, empty array passed',$response->error->message);
    }

     /**
     *
     */
    public function testRenameFileWithMissingFilePath()
    {
        $filePath = '';
        $newFileName = 'sample-file2.jpg';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
        ];

        $response = $this->client->rename($requestBody);

        FileTest::assertEquals('Missing parameter filePath and/or newFileName for Rename File API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithMissingNewFileName()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = '';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
        ];

        $response = $this->client->rename($requestBody);

        FileTest::assertEquals('Missing parameter filePath and/or newFileName for Rename File API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersion()
    {
        $fileId = 'fileId';
        $versionId = 'versionId';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $responseBody = [
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
            "versionInfo" => [
                "id" => "598821f949c0a938d57563bd",
                "name" => "Version 1"
            ],
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

        $response = $this->mockClient->restoreFileVersion($requestBody);

        $request = $container[0]['request'];
        $queryString = $request->getUri()->getQuery();
        $requestPath = $request->getUri()->getPath();

        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);
        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/versions/{$versionId}/restore",$requestPath);
        FileTest::assertEmpty($stream);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PUT');
    }

     /**
     *
     */
    public function testRestoreFileVersionWithInvalidRequest()
    {
        $response = $this->client->restoreFileVersion();

        FileTest::assertEquals('Restore File Version API accepts an array, null passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithNonArrayParameter()
    {
        $fileId = 'fileId';
        $versionId = 'versionId';

        $requestBody = $fileId;

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Restore File Version API accepts an array of parameters, non array value passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithEmptyArrayParameter()
    {
        $requestBody = [];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Restore File Version API accepts an array of parameters, empty array passed',$response->error->message);
    }

     /**
     *
     */
    public function testRestoreFileVersionWithMissingFileId()
    {
        $fileId = '';
        $versionId = 'versionId';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Missing parameter fileId and/or versionId for Restore File Version API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithMissingVersionId()
    {
        $fileId = 'fileId';
        $versionId = '';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Missing parameter fileId and/or versionId for Restore File Version API',$response->error->message);
    }
    

    
    /**
     *
     */
    public function testGetFileMetadataUsingFileId()
    {
        $fileId = '5de4fb65c851e55df73abe8d';
        
        $responseBody = [
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

        $response = $this->mockClient->getFileMetaData($fileId);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $queryString = $request->getUri()->getQuery();
        $stream = Utils::streamFor($request->getBody())->getContents();
        // $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/files/{$fileId}/metadata",$requestPath);
        FileTest::assertEmpty($stream);

        // Response Check
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');        
    }

    
    /**
     *
     */
    public function testGetFileMetadataUsingFileIdWithMissingFileId()
    {
        $fileId = '';
        
        $response = $this->client->getFileMetaData($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURL()
    {
        $remoteURL = 'https://ik.imagekit.io/demo/sample-folder/default-image.jpg';
        
        $requestBody = [
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
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($requestBody));

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->getFileMetadataFromRemoteURL($remoteURL);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $queryString = $request->getUri()->getQuery();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        FileTest::assertEquals("/v1/metadata",$requestPath);
        FileTest::assertEquals($queryString,http_build_query(['url'=>$remoteURL]));

        // Response Check
        FileTest::assertEquals(json_encode($requestBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }



    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURLMissingURL()
    {
        $remoteURL = '';
        
        $response = $this->client->getFileMetadataFromRemoteURL($remoteURL);

        FileTest::assertEquals('Your request is missing the url query paramater', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURLInvalidURL()
    {
        $remoteURL = 'invalid_url';
        
        $response = $this->client->getFileMetadataFromRemoteURL($remoteURL);

        FileTest::assertEquals('Invalid URL provided for this request', $response->error->message);
    }
    
    /**
     *
     */
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
    private function createMockClient($handler){
        $this->mockClient = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo',
            Transformation::DEFAULT_TRANSFORMATION_POSITION,
            $handler
        );
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
