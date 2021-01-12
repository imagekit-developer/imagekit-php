<?php

namespace ImageKit\Tests\ImageKit\Url;

use ImageKit\Url\Url;
use PHPUnit\Framework\TestCase;


$composer = json_decode(
    file_get_contents(__DIR__ . "/../../../composer.json"),
    true
);

define("CURRENT_SDK_VERSION", $composer["version"]);

final class UrlTest extends TestCase
{
    public function testUrlGenerationIfTransformationPositionIsPath()
    {
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
            'transformationPosition' => "path"
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationCustomDomain()
    {
        $parameter = array(
            'urlEndpoint' => "https://images.example.com",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
            'transformationPosition' => "path"
        );
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://images.example.com/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
            'transformationPosition' => "path"
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals('', $url);
    }

    public function testUrlGenerationUsingFullImageUrlWhenPassedSrc()
    {
        $parameter = array(
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'queryParameters' => array('test' => 'params', 'test2' => 'param2'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $this->assertStringNotContainsString("??", $url);
        $this->assertStringNotContainsString("&&", $url);
        $this->assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90&test=params&test2=param2&ik-sdk-version=php-' . CURRENT_SDK_VERSION,
            $url
        );
    }

    public function testUrlGenerationUsingFullImageUrlWhenPassedSrcWithQueryParametersAndTransforamtionPositionIsPath()
    {
        $parameter = array(
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
            'transformationPosition' => 'path',
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern/",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "/path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90'), array("test" => "param")),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'path' => "path/to/my/image.jpg",
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );


        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "query",
            'queryParameters' => array('v' => '123123'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "path",
            'queryParameters' => array('test' => 'param'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => "path/to/my/image.jpg",
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'transformationPosition' => "query",
            'queryParameters' => array('test' => 'param'),
            'expireSeconds' => 300,
        );

        $defaultOptions = array(
            'publicKey' =>  "dummy_public_key",
            'privateKey' =>  "dummy_private_key",
            'urlEndpoint' =>  "https://dummy.example.com",
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

        $this->assertStringNotContainsString('?&', $url);
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

        $this->assertStringNotContainsString('?&', $url);
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
