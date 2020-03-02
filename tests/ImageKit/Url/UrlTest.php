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
            'src' => "https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg",
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
        $opts = array_merge($defaultOptions, $parameter);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertNotEmpty($url);
    }

    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => $faker->url,
            'transformation' => array(array('width' => '200', 'height' => '300')),
            'src' => $faker->url,
            'queryParameters' => array('v' => '123123'),
            'signed' => true,
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

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotEmpty($params['tr']);
        $this->assertEquals('w-200,h-300', $params['tr']);
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

    public function testUrlGenerationUsingFullImageUrl()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'transformation' => array(array('width' => '200', 'height' => '300'), array('rotation' => '90')),
            'src' => "https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg",
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
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90&v=123123&sdk-version=php-' . CURRENT_SDK_VERSION,
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
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $this->assertNotEmpty($params['ik-s']);
    }
}
