<?php

namespace ImageKit\Tests\ImageKit\Upload;

include_once __DIR__ . '/../../../src/ImageKit/Utils/Transformation.php';
include_once __DIR__ . '/../../../src/ImageKit/Utils/Authorization.php';

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;
use function json_encode;

/**
 *
 */

/**
 *
 */
final class UploadTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     *
     */
    public function testFileUploadIfMissingDataUpload()
    {

        $mockBodyResponse = Utils::streamFor(json_encode([
            'width' => 1000
        ]));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar', 'TEST' => 'TEST'],
            $mockBodyResponse));

        $response = $this->client->upload([
            'file' => 'http://lorempixel.com/640/480/',
        ]);

        UploadTest::assertNull($response->success);
        UploadTest::assertEquals('Missing fileName parameter for upload', $response->err->message);
    }

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
    public function testFileUploadIfMissingFileParameter()
    {
        $mockBodyResponse = Utils::streamFor(json_encode([
            'width' => 1000
        ]));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $response = $this->client->upload([
            'fileName' => '7e57d004-2b97-0e7a-b45f-5387367791cd',
        ]);

        UploadTest::assertNull($response->success);
        UploadTest::assertEquals('Missing file parameter for upload', $response->err->message);
    }

    /**
     *
     */
    public function testFileUploadIfMissingDataForUpload()
    {


        $mockBodyResponse = Utils::streamFor(json_encode([
            'width' => 1000
        ]));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));


        $res = $this->client->upload([]);
        $response = json_decode(json_encode($res), true);

        UploadTest::assertNull($response['success']);
        UploadTest::assertEquals('Missing file parameter for upload', $response['err']['message']);
    }

    /**
     *
     */
    public function testFileUploadIfSuccessful()
    {
        $mockBodyResponse = Utils::streamFor(json_encode([
            'width' => 1000
        ]));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $res = $this->client->upload([
            'file' => 'http://lorempixel.com/640/480/',
            'fileName' => '7e57d004-2b97-0e7a-b45f-5387367791cd',
        ]);

        $response = json_decode(json_encode($res), true);

        UploadTest::assertEquals([
            'width' => 1000
        ], $response['success']);
    }

    /**
     *
     */
    public function testFileUploadIfSuccessfulWithAllParameters()
    {

        // parameters
        $file = 'http://lorempixel.com/640/480/';
        $fileName = '7e57d004-2b97-0e7a-b45f-5387367791cd';
        $useUniqueFileName = rand(0, 1) == 1;
        $tags = ['porro', 'sed', 'magni'];
        $folder = 'aut';
        $isPrivateFile = rand(0, 1) == 1;
        $customCoordinates = '10,10,100,100';
        $responseFields = 'name,tags,customCoordinates,isPrivateFile,metadata';
        $metadata = '7e57d004-2b97-0e7a-b45f-5387367791cd';


        $mockBodyResponse = Utils::streamFor(json_encode([
            'name' => $fileName,
            'tags' => $tags,
            'customCoordinates' => $customCoordinates,
            'isPrivateFile' => $isPrivateFile,
            'metadata' => $metadata
        ]));

        $this->stubHttpClient(new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));
        $res = $this->client->upload([
            'file' => $file,
            'fileName' => $fileName,
            'useUniqueFileName' => $useUniqueFileName,
            'tags' => $tags,
            'folder' => $folder
        ]);
        $response = json_decode(json_encode($res), true);

        UploadTest::assertEquals([
            'name' => $fileName,
            'tags' => $tags,
            'customCoordinates' => $customCoordinates,
            'isPrivateFile' => $isPrivateFile,
            'metadata' => $metadata
        ], $response['success']);
    }

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );
    }

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
