<?php

namespace ImageKit\Tests\ImageKit\Manage;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Utils\Transformation;
use ImageKit\Manage\Cache;
use ImageKit\Resource\GuzzleHttpWrapper;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class CacheTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     * 
     */
    public function testPurgeCache()
    {
        $image_url = 'https://ik.imagekit.io/demo/sample-folder/sample-file.jpg';

        $responseBody = [
            "requestId" => "598821f949c0a938d57563bd"
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

        $response = $this->mockClient->purgeCache($image_url);
        
        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);

        // Request Check
        CacheTest::assertEquals("/v1/files/purge",$requestPath);
        CacheTest::assertEquals($stream['url'],$image_url);

        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    /**
     * 
     */
    public function testPurgeCacheWithMissingImageURL()
    {
        $image_url = '';

        $response = $this->client->purgeCache($image_url);

        CacheTest::assertEquals('Missing URL parameter for this request', $response->error->message);
    }
    
    /**
     * 
     */
    public function testPurgeCacheWithInvalidImageURL()
    {
        $image_url = 'image_url';

        $response = $this->client->purgeCache($image_url);

        CacheTest::assertEquals('Invalid URL provided for this request', $response->error->message);
    }

    /**
     * 
     */
    public function testPurgeCacheStatus()
    {
        $cacheRequestId = '598821f949c0a938d57563bd';
        
        $responseBody = [
            "status" => "Pending"
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
        
        $response = $this->mockClient->purgeCacheStatus($cacheRequestId);

        $request = $container[0]['request'];
        $requestPath = $request->getUri()->getPath();
        $stream = Utils::streamFor($request->getBody())->getContents();
        $stream = json_decode($stream,true);
        
        // Request Check
        CacheTest::assertEquals("/v1/files/purge/{$cacheRequestId}",$requestPath);
        CacheTest::assertEmpty($stream);


        // Response Check
        CacheTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     * 
     */
    public function testPurgeCacheStatusWithMissingCacheRequestId()
    {
        $cacheRequestId = '';
        
        $response = $this->client->purgeCacheStatus($cacheRequestId);

        CacheTest::assertEquals('Missing Request ID parameter for this request', $response->error->message);
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
