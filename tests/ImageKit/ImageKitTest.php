<?php

namespace ImageKit\Tests\ImageKit;

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
    /**
     * Successful initialization
     */
    public function test__constructSuccessful()
    {
        $imagekit = new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('Testing_Public_Key', $this->configuration->publicKey, 'Public Key should be equal to Testing_Public_Key');
            Assert::assertEquals('Testing_Private_Key', $this->configuration->privateKey, 'Private Key should be equal to Testing_Private_Key');
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
        $imagekit = new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing', 'path');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('Testing_Public_Key', $this->configuration->publicKey, 'Public Key should be equal to Testing_Public_Key');
            Assert::assertEquals('Testing_Private_Key', $this->configuration->privateKey, 'Private Key should be equal to Testing_Private_Key');
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
        $imagekit = new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing', 'query');
        $assertionClosure = function () {
            Assert::assertInstanceOf(Configuration::class, $this->configuration, "\$configuration should be an instance of Configuration");
            Assert::assertEquals('Testing_Public_Key', $this->configuration->publicKey, 'Public Key should be equal to Testing_Public_Key');
            Assert::assertEquals('Testing_Private_Key', $this->configuration->privateKey, 'Private Key should be equal to Testing_Private_Key');
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
        new ImageKit('Testing_Public_Key', '', '', '');
    }

    /**
     * Failed initialization Missing Url Endpoint
     */
    public function test__constructFailedEmptyUrlEndpoint()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing urlEndpoint during ImageKit initialization');
        new ImageKit('Testing_Public_Key', 'Testing_Private_Key', '', '');
    }

    /**
     * Failed initialization Missing Transformation Position
     */
    public function test__constructFailedEmptyTransformationPosition()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid transformationPosition during ImageKit initialization. Can be one of path or query');
        new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing', '');
    }

    /**
     * Failed initialization Invalid Transformation Position
     */
    public function test__constructFailedInvalidTransformationPosition()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid transformationPosition during ImageKit initialization. Can be one of path or query');
        new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing', 'testing');
    }

    /**
     * Generate Authentication Parameters With Token
     */
    public function testGetAuthenticationParametersWithToken()
    {
        $token = 'your_token';
        $expire = '1582269249';
        $signature = 'ec74886ec07c66be637fcf1c46b69b4e9627ea53';

        $imagekit = new ImageKit('Testing_Public_Key', 'Testing_Private_Key', 'https://ik.imagekit.io/testing');
        $response = $imagekit->getAuthenticationParameters('your_token', '1582269249');

        $el = get_object_vars($response);

        Assert::assertEquals([
            'token' => $token,
            'expire' => $expire,
            'signature' => $signature,
        ], $el);
    }

    /**
     * Test Phash Distance
     */
    public function testPHashDistance()
    {
        $imagekit = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = '63433b3ccf8e1ebe';
        $phash2 = 'f5d2226cd9d32b16';

        $distance = $imagekit->pHashDistance($phash1, $phash2);

        Assert::assertEquals(27, $distance);
    }

    /**
     * Test Similarity
     */
    public function testEvaluateSimilarity()
    {
        $imagekit = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );

        $phash1 = '63433b3ccf8e1ebe';
        $phash2 = 'f5d2226cd9d32b16';

        $similarity = $imagekit->evaluateSimilarity($phash1, $phash2);

        Assert::assertEquals(27, $similarity->distance);
        Assert::assertEquals(0.578125, $similarity->similarityScore);
    }

    /**
     *
     */
    public function testBulkJobStatusInValidJobId()
    {
        $imagekit = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );

        $mockResponse = Utils::streamFor(json_encode([
            'jobId' => '598821f949c0a938d57563bd',
            'type' => 'COPY_FOLDER',
            'status' => 'Completed'
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockResponse));

        $closure = function () use ($stub) {
            $this->httpClient = $stub;
        };
        $doClosure = $closure->bindTo($imagekit, ImageKit::class);
        $doClosure();

        $response = $imagekit->getBulkJobStatus('');
        Assert::assertEquals('Missing Job ID parameter for this request', $response->err->message);
    }

    /**
     *
     */
    public function testBulkJobStatusSuccess()
    {
        $imagekit = new ImageKit(
            'Testing_Public_Key',
            'Testing_Private_Key',
            'https://ik.imagekit.io/demo'
        );

        $mockResponse = Utils::streamFor(json_encode([
            'jobId' => '598821f949c0a938d57563bd',
            'type' => 'COPY_FOLDER',
            'status' => 'Completed'
        ]));

        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method('get')->willReturn(new Response(200, ['X-Foo' => 'Bar'], $mockResponse));

        $closure = function () use ($stub) {
            $this->httpClient = $stub;
        };
        $doClosure = $closure->bindTo($imagekit, ImageKit::class);
        $doClosure();

        $response = $imagekit->getBulkJobStatus('598821f949c0a938d57563bd');

        $el = get_object_vars($response->success);

        Assert::assertEquals([
            'jobId' => '598821f949c0a938d57563bd',
            'type' => 'COPY_FOLDER',
            'status' => 'Completed'
        ], $el);
    }

}
