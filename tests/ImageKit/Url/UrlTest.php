<?php
namespace ImageKit\Tests\ImageKit\Url;

use ImageKit\Url\Url;
use PHPUnit\Framework\TestCase;

final class UrlTest extends TestCase
{
    public function testUrlGenerationIfTransformationPositionIsPath()
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

        $defaultOptions = array(
            'publicKey' => "public_Mo3UCmhjJ2iq89n2xQ5va1jgrds=",
            'privateKey' => "private_2yk2tYC0bcPiNHVG3s4Dpa6Wfzo=",
            'urlEndpoint' => "https://ik.imagekit.io/ot2cky3ujwa/",
            'transformationPosition' => "path"
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $urlInstance->buildURL($opts);
        $this->assertInstanceOf('\ImageKit\Url\Url', $urlInstance);
    }

    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $parameter = array(
            'urlEndpoint' => "https://ik.imagekit.io/demo/pattern",
            'path' => null,
            'transformation' => (['width' => '200', 'height' => '300']),
            'src' => "https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg",
            'queryParameters' => array('v' => '123123'),
            'signed' => true,
            'expireSeconds' => 300,
        );

        $urlOptions = new Url();

        $this->assertInstanceOf('\ImageKit\Url\Url', $urlOptions);
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
            'publicKey' => "public_Mo3UCmhjJ2iq89n2xQ5va1jgrds=",
            'privateKey' => "private_2yk2tYC0bcPiNHVG3s4Dpa6Wfzo=",
            'urlEndpoint' => "https://ik.imagekit.io/ot2cky3ujwa/",
            'transformationPosition' => "path"
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $urlInstance->buildURL($opts);
        $this->assertInstanceOf('\ImageKit\Url\Url', $urlInstance);
    }

    public function testUrlGenerationUsingFullImageUrl()
    {
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
            'publicKey' => "public_Mo3UCmhjJ2iq89n2xQ5va1jgrds=",
            'privateKey' => "private_2yk2tYC0bcPiNHVG3s4Dpa6Wfzo=",
            'urlEndpoint' => "https://ik.imagekit.io/ot2cky3ujwa/",
            'transformationPosition' => "path"
        );
        $opts = array_merge($parameter, $defaultOptions);

        $urlInstance = new Url();
        $url = $urlInstance->buildURL($opts);
        $this->assertEquals("https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg?tr=w-200%2Ch-300%3Art-90", $url);
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
