<?php

namespace ImageKit\Tests\ImageKit;

use ImageKit\Configuration\Configuration;
use ImageKit\ImageKit;
use ImageKit\Signature\Signature;
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

        Assert::assertEquals([
            'token' => $token,
            'expire' => $expire,
            'signature' => $signature,
        ], $response);
    }

}
