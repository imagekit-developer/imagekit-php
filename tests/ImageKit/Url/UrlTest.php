<?php

namespace ImageKit\Tests\ImageKit\Url;

use ImageKit\ImageKit;
use ImageKit\Url\Url;
use PHPUnit\Framework\TestCase;

/**
 *
 */
final class UrlTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

    /**
     * @before
     */
    public function initTest()
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );
    }

    /**
     *
     */
    public function testUrlNoPathNoSrc()
    {
        $url = $this->client->url();
        UrlTest::assertEquals('URL Generation Method accepts an array, null passed', json_decode($url)->error->message);
    }

    /**
     *
     */
    public function testUrlNoTransformationPath()
    {
        $url = $this->client->url(['path' => '/default-image.jpg']);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlNoTransformationSrc()
    {
        $url = $this->client->url(['src' => 'https://ik.imagekit.io/demo/default-image.jpg']);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlNullParametersWithPath()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => null,
            'transformationPosition' => null,
            'src' => null
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrl()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true
        ]);
        UrlTest::assertContains(
            'ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithEmptyExpiryString()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true,
            'expireSeconds' => ''
        ]);
        
        UrlTest::assertContains(
            'ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithInvalidExpiryString()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true,
            'expireSeconds' => 'asdad'
        ]);
        UrlTest::assertEquals('expireSeconds accepts an integer value, non integer value provided.',json_decode($url)->error->message);
    }

    /**
     *
     */
    public function testUrlSignedUrlWithoutExpiry()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true
        ]);
        UrlTest::assertContains(
            '?ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithExpiryWithTransformation()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            "transformation" => [
                [
                    "height" => "300",
                ]
            ],
            'signed' => true,
            'expireSeconds' => 300
        ]);
        UrlTest::assertContains(
            '?ik-t=',
            $url
        );
        UrlTest::assertContains(
            '&ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithExpiryWithQueryParameters()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            "queryParameters" => 
            [
                "key" => "value"
            ],
            'signed' => true,
            'expireSeconds' => 300
        ]);
        UrlTest::assertContains(
            '&ik-t=',
            $url
        );
        UrlTest::assertContains(
            '&ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithExpiryWithTransformationWithQueryParameters()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            "queryParameters" => 
            [
                "key" => "value"
            ],
            "transformation" => [
                [
                    "height" => "300",
                ]
            ],
            'signed' => true,
            'expireSeconds' => 300
        ]);
        UrlTest::assertContains(
            '&ik-t=',
            $url
        );
        UrlTest::assertContains(
            '&ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithoutExpiryWithTransformationWithQueryParameters()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            "queryParameters" => 
            [
                "key" => "value"
            ],
            "transformation" => [
                [
                    "height" => "300",
                ]
            ],
            'signed' => true
        ]);
        UrlTest::assertNotContains(
            '&ik-t=',
            $url
        );
        UrlTest::assertContains(
            '&ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithExpiry()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true,
            'expireSeconds' => 100
        ]);
        UrlTest::assertStringStartsWith(
            'https://ik.imagekit.io/demo/default-image.jpg',
            $url
        );
        UrlTest::assertContains(
            'ik-s=',
            $url
        );
        UrlTest::assertContains(
            'ik-t=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedWithDiacriticInFilename()
    {
        $url = 'https://ik.imagekit.io/demo/test_é_path_alt.jpg';
        $urlInstance = new Url();
        $encodedUrl = $urlInstance->encodeStringIfRequired($url);
        UrlTest::assertEquals('https://ik.imagekit.io/demo/test_%C3%A9_path_alt.jpg', $encodedUrl);

        $opts = [
            'privateKey' => 'testing_private_key',
            'url' => $url,
            'urlEndpoint' => 'https://ik.imagekit.io/demo',
            'expiryTimestamp' => '9999999999'
        ];
        $signature = $urlInstance->getSignature($opts);
        $url = $this->client->url([
            'path' => '/test_é_path_alt.jpg',
            'signed' => true,
            'expireSeconds' => ''
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/test_é_path_alt.jpg?ik-s='. $signature,
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedWithDiacriticInFilenameAndPath()
    {
        $url = 'https://ik.imagekit.io/demo/aéb/test_é_path_alt.jpg';
        $urlInstance = new Url();
        $encodedUrl = $urlInstance->encodeStringIfRequired($url);
        UrlTest::assertEquals('https://ik.imagekit.io/demo/a%C3%A9b/test_%C3%A9_path_alt.jpg', $encodedUrl);

        $opts = [
            'privateKey' => 'testing_private_key',
            'url' => $url,
            'urlEndpoint' => 'https://ik.imagekit.io/demo',
            'expiryTimestamp' => '9999999999'
        ];
        $signature = $urlInstance->getSignature($opts);
        $url = $this->client->url([
            'path' => '/aéb/test_é_path_alt.jpg',
            'signed' => true,
            'expireSeconds' => ''
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/aéb/test_é_path_alt.jpg?ik-s='. $signature,
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedWithDiacriticInFilenamePathTransforamtionInPath()
    {
        $url = 'https://ik.imagekit.io/demo/tr:l-text,i-Imagekité,fs-50,l-end/aéb/test_é_path_alt.jpg';
        $urlInstance = new Url();
        $encodedUrl = $urlInstance->encodeStringIfRequired($url);
        UrlTest::assertEquals('https://ik.imagekit.io/demo/tr:l-text,i-Imagekit%C3%A9,fs-50,l-end/a%C3%A9b/test_%C3%A9_path_alt.jpg', $encodedUrl);

        $opts = [
            'privateKey' => 'testing_private_key',
            'url' => $url,
            'urlEndpoint' => 'https://ik.imagekit.io/demo',
            'expiryTimestamp' => '9999999999'
        ];
        $signature = $urlInstance->getSignature($opts);
        $url = $this->client->url([
            'path' => '/aéb/test_é_path_alt.jpg',
            'signed' => true,
            "transformation" => [
                [
                    "raw" => "l-text,i-Imagekité,fs-50,l-end"
                ]
            ],
            "transformationPosition" => "path",
            'expireSeconds' => ''
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:l-text,i-Imagekité,fs-50,l-end/aéb/test_é_path_alt.jpg?ik-s='. $signature,
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedWithDiacriticInFilenamePathTransforamtionInQuery()
    {
        $url = 'https://ik.imagekit.io/demo/aéb/test_é_path_alt.jpg?tr=l-text,i-Imagekité,fs-50,l-end';
        $urlInstance = new Url();
        $encodedUrl = $urlInstance->encodeStringIfRequired($url);
        UrlTest::assertEquals('https://ik.imagekit.io/demo/a%C3%A9b/test_%C3%A9_path_alt.jpg?tr=l-text,i-Imagekit%C3%A9,fs-50,l-end', $encodedUrl);

        $opts = [
            'privateKey' => 'testing_private_key',
            'url' => $url,
            'urlEndpoint' => 'https://ik.imagekit.io/demo',
            'expiryTimestamp' => '9999999999'
        ];
        $signature = $urlInstance->getSignature($opts);
        $url = $this->client->url([
            'path' => '/aéb/test_é_path_alt.jpg',
            'signed' => true,
            "transformation" => [
                [
                    "raw" => "l-text,i-Imagekité,fs-50,l-end"
                ]
            ],
            "transformationPosition" => "query",
            'expireSeconds' => ''
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/aéb/test_é_path_alt.jpg?tr=l-text,i-Imagekité,fs-50,l-end&ik-s='. $signature,
            $url
        );
    }

    /**
     *
     */
    public function testUrlURLWithPath()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlURLWithPathNoLeadingSlash()
    {
        $url = $this->client->url([
            'path' => 'default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }


    /**
     *
     */
    public function testUrlURLWithPathMultipleLeadingSlash()
    {
        $url = $this->client->url([
            'path' => '////default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlURLOverrideUrlEndpoint()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/test/',
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/test/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlPathTransformationQuery()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformationPosition' => 'query',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg?tr=h-300,w-400',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSrcTransformation()
    {
        $url = $this->client->url([
            'src' => 'https://ik.imagekit.io/demo/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSrcTransformationQuery()
    {
        $url = $this->client->url([
            'src' => 'https://ik.imagekit.io/demo/default-image.jpg',
            'transformationPosition' => 'query',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg?tr=h-300,w-400',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSrcMergeQueryParams()
    {
        $url = $this->client->url([
            'src' => 'https://ik.imagekit.io/demo/default-image.jpg?t1=v1&t3=v3',
            'queryParameters' => ['t2' => 'v2'],
            'transformationPosition' => 'query',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg?tr=h-300,w-400&t1=v1&t2=v2&t3=v3',
            $url
        );
    }

    /**
     *
     */
    public function testUrlPathMergeQueryParams()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'queryParameters' => ['t1' => 'v1', 't2' => 'v2', 't3' => 'v3'],
            'transformationPosition' => 'query',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/default-image.jpg?tr=h-300,w-400&t1=v1&t2=v2&t3=v3',
            $url
        );
    }

    /**
     *
     */
    public function testUrlChainedTransformation()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ], [
                    'rotate' => 90
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400:rt-90/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlUndocumentedTransformation()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'undocumented' => 'param'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:undocumented-param/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlChainedTransformationUndocumentedTransformation()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400
                ], [
                    'undocumented' => 'param'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400:undocumented-param/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlOverLayImage()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'raw' => "l-image,i-default-image.jpg,w-100,b-10_CDDC39,l-end"
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,l-image,i-default-image.jpg,w-100,b-10_CDDC39,l-end/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlOverLayImageWithPath()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'raw' => "l-image,i-/path/to/overlay.jpg,w-100,b-10_CDDC39,l-end"
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,l-image,i-/path/to/overlay.jpg,w-100,b-10_CDDC39,l-end/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlBorder()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'border' => '20_FF0000'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,b-20_FF0000/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlESharpen()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'e-sharpen' => '-',
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,e-sharpen/default-image.jpg',
            $url
        );
    }

     /**
     *
     */
    public function testUrlRaw()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'raw' => 'h-300,w-400'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400/default-image.jpg',
            $url
        );
    }


    /**
     *
     */
    public function testUrlAllCombined()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'aspectRatio' => '4-3',
                    'quality' => 40,
                    'crop' => 'force',
                    'cropMode' => 'extract',
                    'focus' => 'left',
                    'format' => 'jpeg',
                    'radius' => 50,
                    'bg' => 'A94D34',
                    'border' => '5-A94D34',
                    'rotation' => 90,
                    'blur' => 10,
                    'named' => 'some_name',
                    'progressive' => true,
                    'lossless' => true,
                    'trim' => 5,
                    'metadata' => true,
                    'colorProfile' => true,
                    'defaultImage' => 'folder/file.jpg/', //trailing slash case
                    'dpr' => 3,
                    'effectSharpen' => 10,
                    'effectUSM' => '2-2-0.8-0.024',
                    'effectContrast' => true,
                    'effectGray' => true,
                    'effectShadow' => 'bl-15_st-40_x-10_y-N5',
                    'effectGradient' => 'from-red_to-white',
                    'original' => true,
                    'raw' => 'h-500,w-450'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,ar-4-3,q-40,c-force,cm-extract,fo-left,f-jpeg,r-50,bg-A94D34,b-5-A94D34,rt-90,bl-10,n-some_name,pr-true,lo-true,t-5,md-true,cp-true,di-folder@@file.jpg,dpr-3,e-sharpen-10,e-usm-2-2-0.8-0.024,e-contrast-true,e-grayscale-true,e-shadow-bl-15_st-40_x-10_y-N5,e-gradient-from-red_to-white,orig-true,h-500,w-450/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfTransformationPositionIsPath()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'queryParameters' => ['v' => '123123']
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationCustomDomain()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://images.example.com',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'queryParameters' => ['v' => '123123']
        ]);

        UrlTest::assertEquals(
            'https://images.example.com/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfTransformationPositionIsQuery()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300']],
            'queryParameters' => ['v' => '123123'],
            'transformationPosition' => 'query',
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200,h-300&v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfPathAndSrcEmpty()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => '',
            'src' => '',
            'transformationPosition' => 'path',
            'transformation' => [['width' => '200', 'height' => '300']],
            'queryParameters' => ['v' => '123123'],
            'signed' => true,
            'expireSeconds' => 300,
        ]);

        UrlTest::assertEquals('src is not a valid URL', json_decode($url)->error->message);

    }

    /**
     *
     */
    public function testUrlGenerationIfUrlEmptyEmpty()
    {
        $url = $this->client->url([
            'urlEndpoint' => '',
            'transformationPosition' => 'path',
            'transformation' => [['width' => '200', 'height' => '300']],
            'queryParameters' => ['v' => '123123'],
            'signed' => true,
            'expireSeconds' => 300,
        ]);

        UrlTest::assertEquals('Invalid urlEndpoint value', json_decode($url)->error->message);

    }

    /**
     *
     */
    public function testUrlGenerationUsingFullImageUrlWhenPassedSrc()
    {
        $url = $this->client->url([
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/tr:w-200,h-300:rt-90/default-image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationUsingFullImageUrlWhenPassedSrcWithQueryParameters()
    {

        $url = $this->client->url([
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
            'queryParameters' => ['test' => 'params', 'test2' => 'param2'],
            'expireSeconds' => 300,
        ]);

        // UrlTest::assertNotRegExp('/??/', $url);
        // UrlTest::assertNotRegExp('/&&/', $url);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/tr:w-200,h-300:rt-90/default-image.jpg?test=params&test2=param2',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationUsingFullImageUrlWhenPassedSrcWithQueryParametersAndTransforamtionPositionIsPath()
    {
        $url = $this->client->url([
            'src' => 'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
            'transformationPosition' => 'path',
            'expireSeconds' => 300,
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/your_imagekit_id/endpoint/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testSignedUrlGeneration()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'signed' => true,
            'expireSeconds' => 300,
        ]);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        UrlTest::assertNotEmpty($params['ik-s']);
        UrlTest::assertNotEmpty($params['ik-t']);
    }

    /**
     *
     */
    public function testUrlGenerationIfInitializationUrlEndpointIsOverriddenByNewUrlEndpoint()
    {

        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfPresenceOfTrailingSlashInUrlEndpointWillGenerateValidUrl()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern/',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfPresenceOfLeadingSlashInPathWillGenerateValidUrl()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => '/path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationIfNewTransformationParameterIsPassedWillBePresentInGeneratedUrl()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90'], ['test' => 'param']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90:test-param/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    // /**
    //  *
    //  */
    // public function testUrlGenerationIfGeneratedUrlContainsSDKVersion()
    // {
    //     $url = $this->client->url([
    //         'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
    //         'transformation' => [['width' => '200', 'height' => '300']],
    //         'path' => 'path/to/my/image.jpg',
    //         'transformationPosition' => 'query',
    //         'queryParameters' => ['v' => '123123'],
    //         'expireSeconds' => 300,
    //     ]);

    //     $url_components = parse_url($url);
    //     parse_str($url_components['query'], $params);

    //     UrlTest::assertNotEmpty($params['ik-sdk-version']);
    //     UrlTest::assertEquals('php-', $params['ik-sdk-version']);
    // }

    /**
     *
     */
    public function testUrlGenerationIfTransformationPositionIsQueryAndTransformationArePresentInUrlAsQueryParams()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'transformation' => [['width' => '200', 'height' => '300']],
            'path' => 'path/to/my/image.jpg',
            'transformationPosition' => 'query',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        UrlTest::assertNotEmpty($params['tr']);
        UrlTest::assertEquals('w-200,h-300', $params['tr']);
    }

    /**
     *
     */
    public function testUrlGenerationWithChainedTransformationIfTransformationPositionIsPath()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationWithChainedTransformationIfTransformationPositionIsQuery()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'query',
            'queryParameters' => ['v' => '123123'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200,h-300:rt-90&v=123123',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationWithQueryParametersIfTransformationPositionIsPath()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'path',
            'queryParameters' => ['test' => 'param'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:w-200,h-300:rt-90/path/to/my/image.jpg?test=param',
            $url
        );
    }

    /**
     *
     */
    public function testUrlGenerationWithQueryParametersIfTransformationPositionIsQuery()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['width' => '200', 'height' => '300'], ['rotation' => '90']],
            'transformationPosition' => 'query',
            'queryParameters' => ['test' => 'param'],
            'expireSeconds' => 300,
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/path/to/my/image.jpg?tr=w-200,h-300:rt-90&test=param',
            $url
        );
    }

    // /**
    //  *
    //  */
    // public function testUrlGenerationWithDefaultExpiredSeconds()
    // {
    //     $url = $this->client->url([
    //         'path' => '/test-signed-url.png',
    //         'transformation' => [['width' => '100']],
    //         'signed' => true,
    //     ]);

    //     $url_components = parse_url($url);
    //     parse_str($url_components['query'], $params);

    //     UrlTest::assertStringNotContainsString('?&', $url);
    //     UrlTest::assertNotEmpty($params['ik-s']);
    // }

    /**
     *
     */
    public function testUrlGenerationWithCustomExpiredSeconds()
    {
        $url = $this->client->url([
            'path' => '/test-signed-url.png',
            'transformation' => [['width' => '100']],
            'signed' => true,
            'expireSeconds' => 300
        ]);

        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        // UrlTest::assertNotRegExp('/?&/', $url);
        UrlTest::assertNotEmpty($params['ik-t']);
    }

    /**
     *
     */
    public function testTransformationWithoutValueShouldNotHaveHypen()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['orig' => '']],
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:orig/path/to/my/image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testTransformationValueShouldBeConvertedToString()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['rt' => 90, 'orig' => true]],
        ]);
        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:rt-90,orig-true/path/to/my/image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testTransformationNonMappedSupportedTransform()
    {
        $url = $this->client->url([
            'urlEndpoint' => 'https://ik.imagekit.io/demo/pattern',
            'path' => 'path/to/my/image.jpg',
            'transformation' => [['not_mapped' => 'value', '' => '']],
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/pattern/tr:not_mapped-value/path/to/my/image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUnitTestGeneratedSignature()
    {
        $opts = [
            'privateKey' => 'private_key_test',
            'url' => 'https://test-domain.com/test-endpoint/tr:w-100/test-signed-url.png',
            'urlEndpoint' => 'https://test-domain.com/test-endpoint',
            'expiryTimestamp' => '9999999999'
        ];

        $urlInstance = new Url();
        $signature = $urlInstance->getSignature($opts);

        UrlTest::assertEquals('41b3075c40bc84147eb71b8b49ae7fbf349d0f00', $signature);
    }

}
