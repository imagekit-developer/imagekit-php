<?php
namespace ImageKit\Tests\ImageKit\Url;

use ImageKit\Url\Url;
use PHPUnit\Framework\TestCase;
use Faker;

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
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $urlInstance->buildURL($opts);
        $this->assertInstanceOf('\ImageKit\Url\Url', $urlInstance);
    }

    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            'urlEndpoint' => $faker->url,
            'path' => null,
            'transformation' => (['width' => '200', 'height' => '300']),
            'src' => $faker->url,
            'queryParameters' => array('v' => '123123'),
            'signed' => true,
            'expireSeconds' => 300,
        );

        $urlOptions = new Url();

        $this->assertInstanceOf('\ImageKit\Url\Url', $urlOptions);
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
        $urlInstance->buildURL($opts);
        $this->assertInstanceOf('\ImageKit\Url\Url', $urlInstance);
    }

    public function testUrlGenerationUsingFullImageUrl()
    {
        $faker = Faker\Factory::create();
        $parameter = array(
            // 'urlEndpoint' => "",
            // 'path' => "",
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
            'transformationPosition' => "path"
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals("https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90&sdk-version=php-1.0.0", $url);
    }


    public function testSignedUrlGeneration()
    {
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
        $urlOptions = new Url();
        $this->assertInstanceOf('\ImageKit\Url\Url', $urlOptions);
    }


}
