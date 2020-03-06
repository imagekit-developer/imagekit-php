<?php

namespace ImageKit\Tests\ImageKit\Url;

use ImageKit\Url\Url;
use PHPUnit\Framework\TestCase;
use Faker;

$composer = json_decode(
    file_get_contents(__DIR__ . "/../../../composer.json"),
    true
);

define("CURRENT_SDK_VERSION", $composer["version"]);

final class UrlTest extends TestCase
{
    public function testUrlGenerationIfTransformationPositionIsPath()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
            'transformationPosition' => $faker->word
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200%2Ch-300&v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfPathAndSrcEmpty()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "",
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'signed' => true,
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
            'transformationPosition' => $faker->word
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals('', $url);
    }

    public function testUrlGenerationUsingFullImageUrlWhenPassedSrc()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90&v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationUsingFullImageUrlWhenPassedSrcWithQueryParameters()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'queryParameters' => array('test' => 'params', 'test2' => 'param2'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $this->assertNotContains("??", $url);
        $this->assertNotContains("&&", $url);
        $this->assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90&test=params&test2=param2&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationUsingFullImageUrlWhenPassedSrcWithQueryParametersAndTransforamtionPositionIsPath()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'transformationPosition' => 'path',
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $this->assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testSignedUrlGeneration()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'signed' => true,
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotEmpty($params['ik-s']);
        $this->assertNotEmpty($params['ik-t']);
    }

    public function testUrlGenerationIfInitializationUrlEndpointIsOverriddenByNewUrlEndpoint()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfPresenceOfTrailingSlashInUrlEndpointWillGenerateValidUrl()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern/",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfPresenceOfLeadingSlashInPathWillGenerateValidUrl()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "/path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfNewTransformationParameterIsPassedWillBePresentInGeneratedUrl()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90'), array("test" => "param")),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90:test-param/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfGeneratedUrlContainsSDKVersion()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotEmpty($params['ik-sdk-version']);
        $this->assertEquals('php-' . CURRENT_SDK_VERSION, $params['ik-sdk-version']);
    }

    public function testUrlGenerationIfTransformationPositionIsQueryAndTransformationArePresentInUrlAsQueryParams()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' => $faker->uuid,
            'privateKey' => $faker->uuid,
            'urlEndpoint' => $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotEmpty($params['tr']);
        $this->assertEquals('w-200,h-300', $params['tr']);
    }

    public function testUrlGenerationWithChainedTransformationIfTransformationPositionIsPath()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationWithChainedTransformationIfTransformationPositionIsQuery()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200%2Ch-300%3Art-90&v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationWithQueryParametersIfTransformationPositionIsPath()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('test' => 'param'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?test=param&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationWithQueryParametersIfTransformationPositionIsQuery()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "query",
            'queryParameters' => array('test' => 'param'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  $faker->uuid,
            'privateKey' =>  $faker->uuid,
            'urlEndpoint' =>  $faker->url,
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200%2Ch-300%3Art-90&test=param&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationWithDefaultExpiredSeconds()
    {
        $parameter = array(
            'path' => "/test-signed-url.png",
            'transformation' => array(array('width' => '100')),
            'signed' => true,
        );

        $defaultOptions = array(
            'publicKey' =>  "public_key_test",
            'privateKey' =>  "private_key_test",
            'urlEndpoint' =>  "https://test-domain.com/test-endpoint"
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotContains('?&', $url);
        $this->assertNotEmpty($params['ik-s']);
    }

    public function testUrlGenerationWithCustomExpiredSeconds()
    {
        $parameter = array(
            'path' => "/test-signed-url.png",
            'transformation' => array(array('width' => '100')),
            'signed' => true,
            'expireSeconds' => 300
        );

        $defaultOptions = array(
            'publicKey' =>  "public_key_test",
            'privateKey' =>  "private_key_test",
            'urlEndpoint' =>  "https://test-domain.com/test-endpoint"
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotContains('?&', $url);
        $this->assertNotEmpty($params['ik-t']);
    }

    public function testGeneratedSignature()
    {
        $opts = array(
            'privateKey' => 'private_key_test',
            'url' => 'https://test-domain.com/test-endpoint/tr:w-100/test-signed-url.png',
            'urlEndpoint' => 'https://test-domain.com/test-endpoint',
            'expiryTimestamp' => '9999999999'
        );

        $urlInstance = new Url();
        $signature = $urlInstance->getSignature($opts);

        $this->assertEquals('41b3075c40bc84147eb71b8b49ae7fbf349d0f00', $signature);
    }
}
