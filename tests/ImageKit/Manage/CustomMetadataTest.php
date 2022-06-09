<?php

namespace ImageKit\Tests\ImageKit\Manage;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Manage\Cache;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

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

        $this->stubHttpClient('post', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->createCustomMetadataField($requestBody);

        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
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

        $this->stubHttpClient('get', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

         $response = $this->client->getCustomMetadataFields($includeDeleted);

        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
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

        $this->stubHttpClient('patch', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateCustomMetadataField($customMetadataFieldId, $requestBody);

        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
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

        $this->stubHttpClient('delete', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteCustomMetadataField($customMetadataFieldId);

        CacheTest::assertNull($response->result);    
        CacheTest::assertNull($response->error);    
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
