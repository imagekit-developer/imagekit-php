<?php

namespace ImageKit\Tests\ImageKit;

use Exception;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\Configuration\Configuration;
use ImageKit\ImageKit;
use ImageKit\Resource\GuzzleHttpWrapper;
use InvalidArgumentException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;


/**
 * This class tests for Client and Auxillary Functions in ImageKit SDK
 */
class ImageKitTest extends TestCase
{
    private $client;

    /**
     * Successful initialization
     */
    public function test__constructSuccessful()
    {
        $imagekit = new ImageKit('testing_public_key', 'testing_private_key', 'https://ik.imagekit.io/testing');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('testing_public_key', $this->configuration->publicKey, 'Public Key should be equal to testing_public_key');
            Assert::assertEquals('testing_private_key', $this->configuration->privateKey, 'Private Key should be equal to testing_private_key');
            Assert::assertEquals('https://ik.imagekit.io/testing', $this->configuration->urlEndpoint, 'Url Endpoint should be equal to https://ik.imagekit.io/testing');
            Assert::assertEquals('path', $this->configuration->transformationPosition, 'Transformation Position should be equal to path');
        };
        $doAssertClosure = $assertionClosure->bindTo($imagekit, ImageKit::class);
        $doAssertClosure();
    }

    /**
     * Successful initialization with TransformationPosition as Path
     */
    public function test__constructSuccessfulWithTransformationPositionPath()
    {
        $imagekit = new ImageKit('testing_public_key', 'testing_private_key', 'https://ik.imagekit.io/testing', 'path');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('testing_public_key', $this->configuration->publicKey, 'Public Key should be equal to testing_public_key');
            Assert::assertEquals('testing_private_key', $this->configuration->privateKey, 'Private Key should be equal to testing_private_key');
            Assert::assertEquals('https://ik.imagekit.io/testing', $this->configuration->urlEndpoint, 'Url Endpoint should be equal to https://ik.imagekit.io/testing');
            Assert::assertEquals('path', $this->configuration->transformationPosition, 'Transformation Position should be equal to path');
        };
        $doAssertClosure = $assertionClosure->bindTo($imagekit, ImageKit::class);
        $doAssertClosure();
    }

    /**
     * Successful initialization with TransformationPosition as Query
     */
    public function test__constructSuccessfulWithTransformationPositionQuery()
    {
        $imagekit = new ImageKit('testing_public_key', 'testing_private_key', 'https://ik.imagekit.io/testing', 'query');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('testing_public_key', $this->configuration->publicKey, 'Public Key should be equal to testing_public_key');
            Assert::assertEquals('testing_private_key', $this->configuration->privateKey, 'Private Key should be equal to testing_private_key');
            Assert::assertEquals('https://ik.imagekit.io/testing', $this->configuration->urlEndpoint, 'Url Endpoint should be equal to https://ik.imagekit.io/testing');
            Assert::assertEquals('query', $this->configuration->transformationPosition, 'Transformation Position should be equal to path');
        };
        $doAssertClosure = $assertionClosure->bindTo($imagekit, ImageKit::class);
        $doAssertClosure();
    }

    /**
     * Failed initialization Missing Public Key
     */
    public function test__constructFailedEmptyPublicKey()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing publicKey during ImageKit initialization');
        new ImageKit('', '', '', '');
    }

    /**
     * Failed initialization Missing Private Key
     */
    public function test__constructFailedEmptyPrivateKey()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing privateKey during ImageKit initialization');
        new ImageKit('testing_public_key', '', '', '');
    }

    /**
     * Failed initialization Missing Url Endpoint
     */
    public function test__constructFailedEmptyUrlEndpoint()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing urlEndpoint during ImageKit initialization');
        new ImageKit('testing_public_key', 'testing_private_key', '', '');
    }

    /**
     * Failed initialization Missing Transformation Position
     */
    public function test__constructFailedEmptyTransformationPosition()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid transformationPosition during ImageKit initialization. Can be one of path or query');
        new ImageKit('testing_public_key', 'testing_private_key', 'https://ik.imagekit.io/testing', '');
    }

    /**
     * Failed initialization Invalid Transformation Position
     */
    public function test__constructFailedInvalidTransformationPosition()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid transformationPosition during ImageKit initialization. Can be one of path or query');
        new ImageKit('testing_public_key', 'testing_private_key', 'https://ik.imagekit.io/testing', 'testing');
    }


    /**
     * Failed initialization Invalid URL Endpoint
     */
    public function test__constructFailedInvalidURLEndpoint()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('urlEndpoint should be a valid URL');
        new ImageKit('testing_public_key', 'testing_private_key', 'wrong_url', 'path');
    }

    /**
     * Generate Authentication Parameters With Token
     */
    public function testGetAuthenticationParametersWithToken()
    {
        $token = 'your_token';
        $expire = 1582269249;
        $signature = 'e71bcd6031016b060d349d212e23e85c791decdd';

        $imagekit = new ImageKit('public_key_test', 'private_key_test', 'https://ik.imagekit.io/testing');
        $response = $imagekit->getAuthenticationParameters('your_token', 1582269249);


        Assert::assertEquals(json_encode([
            'token' => $token,
            'expire' => $expire,
            'signature' => $signature,
        ]), json_encode($response->result));
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistance()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = '63433b3ccf8e1ebe';
        $phash2 = 'f5d2226cd9d32b16';

        $distance = $imagekit->pHashDistance($phash1, $phash2);

        Assert::assertEquals(27, $distance);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistanceEmptyPhash1()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = '';
        $phash2 = 'f5d2226cd9d32b16';

        $response = $imagekit->pHashDistance($phash1, $phash2);

        ImageKitTest::assertEquals('Missing First pHash parameter for this request',$response->error->message);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistanceEmptyPhash2()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = 'f5d2226cd9d32b16';
        $phash2 = '';


        $response = $imagekit->pHashDistance($phash1, $phash2);

        ImageKitTest::assertEquals('Missing Second pHash parameter for this request',$response->error->message);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistanceInvalidPhash1()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = 'asdadasda';
        $phash2 = 'f5d2226cd9d32b16';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid pHash value');

        $imagekit->pHashDistance($phash1, $phash2);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistanceInvalidPhash2()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = 'f5d2226cd9d32b16';
        $phash2 = 'asjdkajlkda';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid pHash value');

        $imagekit->pHashDistance($phash1, $phash2);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistancePhashesLengthNotEqual()
    {
        $imagekit = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = 'f5d2226cd9d32b16';
        $phash2 = 'f5d2226cd9d32b16f5d2226cd9d32b16';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid pHash value');

        $imagekit->pHashDistance($phash1, $phash2);
    }

    
    /**
     *
     */
    public function testGetBulkJobStatus()
    {
        $jobId = '598821f949c0a938d57563bd';

        $responseBody = [
            "jobId" => "598821f949c0a938d57563bd",
            "type" => "COPY_FOLDER",
            "status" => "Completed"
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getBulkJobStatus($jobId);

        ImageKitTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     *
     */
    public function testGetBulkJobStatusMissingJobId()
    {
        $jobId = '';

        $response = $this->client->getBulkJobStatus($jobId);

        ImageKitTest::assertEquals('Missing Job ID parameter for this request',$response->error->message);
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

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );
    }

    protected function tearDown():void
    {
        $this->client = null;
    }
}
