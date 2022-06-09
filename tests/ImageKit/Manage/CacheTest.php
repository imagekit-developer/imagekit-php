<?php

namespace ImageKit\Tests\ImageKit\Manage;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Manage\Cache;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

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

        $this->stubHttpClient('post', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->purgeCache($image_url);

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

        $this->stubHttpClient('get', new Response(201, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->purgeCacheStatus($cacheRequestId);

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

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
