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

class CustomMetadataTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     * 
     */
    public function testCreateFields()
    {
        $requestBody = [
            "name" => "price",      
            "label" => "Unit Price",
            "schema" => [           
                "type" => 'Number', 
                "minValue" => 1000,
                "maxValue" => 5000,
            ],
        ];
        
        $responseBody = [
            "id" => "598821f949c0a938d57563dd",
            "name" => "price",
            "label" => "Unit Price",
            "schema" => [
                "type" => "Number",
                "minValue" => 1000,
                "maxValue" => 5000
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

        $response = $this->mockClient->createCustomMetadataField($requestBody);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        CacheTest::assertEquals("/v1/customMetadataFields",$requestPath);
        CacheTest::assertEquals($stream['name'],$requestBody['name']);
        CacheTest::assertEquals($stream['label'],$requestBody['label']);
        CacheTest::assertEquals($stream['schema'],$requestBody['schema']);
        CacheTest::assertEquals($stream['schema']['type'],$requestBody['schema']['type']);
        CacheTest::assertEquals($stream['schema']['minValue'],$requestBody['schema']['minValue']);
        CacheTest::assertEquals($stream['schema']['maxValue'],$requestBody['schema']['maxValue']);

        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'POST');
    }

    /**
     * 
     */
    public function testCreateFieldsInvalidRequest()
    {
        
        $response = $this->client->createCustomMetadataField();

        CacheTest::assertEquals('Create Custom Metadata API accepts an array, null passed', $response->error->message);
    
    }
    
    /**
     * 
     */
    public function testCreateFieldsWithNonArrayParameter()
    {
        $requestBody = 'field_name';
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Create Custom Metadata API accepts an array of parameters, non array value passed', $response->error->message);
    
    }
    
    /**
     * 
     */
    public function testCreateFieldsWithEmptyArrayParameter()
    {
        $requestBody = [];
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Create Custom Metadata API accepts an array of parameters, empty array passed', $response->error->message);
    }
    
    /**
     * 
     */
    public function testCreateFieldsWithMissingName()
    {
        $requestBody = [
            "name" => "",  
            "label" => "Unit Price",
            "schema" => [           
                "type" => 'Number', 
                "minValue" => 1000,
                "maxValue" => 5000,
            ],
        ];
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Missing parameter name and/or label and/or schema for this request', $response->error->message);
    }
    
    /**
     * 
     */
    public function testCreateFieldsWithMissingLabel()
    {
        $requestBody = [
            "name" => "price",  
            "label" => "",
            "schema" => [           
                "type" => 'Number', 
                "minValue" => 1000,
                "maxValue" => 5000,
            ],
        ];
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Missing parameter name and/or label and/or schema for this request', $response->error->message);
    }
        
    /**
     * 
     */
    public function testCreateFieldsWithMissingSchema()
    {
        $requestBody = [
            "name" => "price",  
            "label" => "Unit Price",
        ];
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Missing parameter name and/or label and/or schema for this request', $response->error->message);
    }

            
    /**
     * 
     */
    public function testCreateFieldsWithMissingSchemaType()
    {
        $requestBody = [
            "name" => "price",  
            "label" => "Unit Price",
            "schema" => [           
            ],
        ];
        
        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals('Invalid parameter schema', $response->error->message);
    }

    
    /**
     * 
     */
    public function testGetFields()
    {
        $includeDeleted = false;
        
        $responseBody = [
            [
                "id" => "598821f949c0a938d57563dd",
                "name" => "brand",
                "label" => "brand",
                "schema" => [
                    "type" => "Text",
                    "defaultValue" => "Nike"
                ]
            ],
            [
                "id" => "865421f949c0a835d57563dd",
                "name" => "price",
                "label" => "price",
                "schema" => [
                    "type" => "Number",
                    "minValue" => 1000,
                    "maxValue" => 3000
                ]
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

        $response = $this->mockClient->getCustomMetadataFields($includeDeleted);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $queryString = $request->getUri()->getQuery();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);
        
        // Request Check
        CacheTest::assertEquals("/v1/customMetadataFields",$requestPath);
        CacheTest::assertEquals($queryString,http_build_query(['includeDeleted'=>$includeDeleted]));

        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }

    
    /**
     * 
     */
    public function testGetFieldsWithoutIncludeDeleted()
    {
        
        $responseBody = [
            [
                "id" => "598821f949c0a938d57563dd",
                "name" => "brand",
                "label" => "brand",
                "schema" => [
                    "type" => "Text",
                    "defaultValue" => "Nike"
                ]
            ],
            [
                "id" => "865421f949c0a835d57563dd",
                "name" => "price",
                "label" => "price",
                "schema" => [
                    "type" => "Number",
                    "minValue" => 1000,
                    "maxValue" => 3000
                ]
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

        $response = $this->mockClient->getCustomMetadataFields();

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $queryString = $request->getUri()->getQuery();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);
        
        // Request Check
        CacheTest::assertEquals("/v1/customMetadataFields",$requestPath);
        CacheTest::assertEquals($queryString,http_build_query(['includeDeleted'=>false]));

        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'GET');
    }

    /**
     * 
     */
    public function testGetFieldsWithInvalidIncludeDeleted()
    {
        $includeDeleted = 'includeDeleted';
        
        $response = $this->client->getCustomMetadataFields($includeDeleted);

        CacheTest::assertEquals('Invalid parameter includeDeleted', $response->error->message);
    }

    /**
     * 
     */
    public function testUpdateFields()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = [
            "label" => "Net Price",
            "schema" => [
                "type"=>'Number'
            ],
        ];
        
        $responseBody = [
            "id" => "598821f949c0a938d57563dd",
            "name" => "price",
            "label" => "Net Price",
            "schema" => [
                "type" => "Number"
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
        
        $response = $this->mockClient->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        CacheTest::assertEquals("/v1/customMetadataFields/" . $customMetadataFieldId,$requestPath);
        CacheTest::assertEquals($stream['label'],$requestBody['label']);
        CacheTest::assertEquals($stream['schema'],$requestBody['schema']);CacheTest::assertEquals($stream['schema']['type'],$requestBody['schema']['type']);
        
        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'PATCH');
    }

    /**
     * 
     */
    public function testUpdateFieldsInvalidRequest()
    {
        
        $response = $this->client->updateCustomMetadataField();

        CacheTest::assertEquals('Update Custom Metadata API accepts an id and requestBody, null passed', $response->error->message);
    
    }

    
    /**
     * 
     */
    public function testUpdateFieldsWithMissingCustomMetadataFieldId()
    {
        $customMetadataFieldId = '';

        $requestBody = [
            "label" => "Net Price",
            "schema" => [
                "type"=>'Number'
            ],
        ];

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Missing Custom Metadata Field ID parameter for this request', $response->error->message);
    
    }

    
    /**
     * 
     */
    public function testUpdateFieldsWithMissingBody()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId);

        CacheTest::assertEquals('Missing body parameter for this request', $response->error->message);
    
    }

        /**
     * 
     */
    public function testUpdateFieldsWithNonArrayBodyParameter()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = "Net Price";

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Update Custom Metadata API accepts requestBody as an array of parameters, non array value passed', $response->error->message);
    
    }

    /**
     * 
     */
    public function testUpdateFieldsWithEmptyArrayBodyParameter()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = [];

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Update Custom Metadata API accepts an array of parameters, empty array passed', $response->error->message);
    
    }

    /**
     * 
     */
    public function testUpdateFieldsWithMissingLabel()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = [
            "label" => "",
            "schema" => [
                "type"=>'Number'
            ],
        ];

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Missing parameter label and/or schema for this request', $response->error->message);
    
    }

    /**
     * 
     */
    public function testUpdateFieldsWithMissingSchema()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = [
            "label" => "Net Price",
        ];

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Missing parameter label and/or schema for this request', $response->error->message);
    
    }

    /**
     * 
     */
    public function testUpdateFieldsWithMissingSchemaType()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $requestBody = [
            "label" => "Net Price",
            "schema" => [
                "type"=>''
            ],
        ];

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals('Invalid parameter schema', $response->error->message);
    
    }

    /**
     * 
     */
    public function testDeleteFields()
    {
        $customMetadataFieldId = '598821f949c0a938d57563dd';

        $mockBodyResponse = Utils::streamFor();

        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse)
        ]);

        $handlerStack = HandlerStack::create($mock);

        $container = [];
        $history = Middleware::history($container);

        $handlerStack->push($history);
        
        $this->createMockClient($handlerStack);

        $response = $this->mockClient->deleteCustomMetadataField($customMetadataFieldId);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        CacheTest::assertEquals("/v1/customMetadataFields/" . $customMetadataFieldId,$requestPath);
        CacheTest::assertEmpty($stream);

        // Response Check
        CacheTest::assertNull($response->result);    
        CacheTest::assertNull($response->error);    
        
        // Assert Method
        $requestMethod = $container[0]['request']->getMethod();
        FileTest::assertEquals($requestMethod,'DELETE');
    }

    /**
     * 
     */
    public function testDeleteFieldsWithMissingCustomMetadataFieldId()
    {
        $customMetadataFieldId = '';

        $response = $this->client->deleteCustomMetadataField($customMetadataFieldId);

        CacheTest::assertEquals('Missing Custom Metadata Field ID parameter for this request',$response->error->message);  
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

    protected function setUp()
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


    protected function tearDown()
    {
        $this->client = null;
    }
}
