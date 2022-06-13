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
        UrlTest::assertStringContainsString(
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
        
        UrlTest::assertStringContainsString(
            'ik-s=',
            $url
        );
    }

    /**
     *
     */
    public function testUrlSignedUrlWithInvalidExpiryString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('expireSeconds should be numeric');
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'signed' => true,
            'expireSeconds' => 'asdad'
        ]);
        // UrlTest::assertEquals('expireSeconds should be numericasd',$url);
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
        UrlTest::assertStringContainsString(
            'ik-s=',
            $url
        );
        UrlTest::assertStringContainsString(
            'ik-t=',
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
                    'overlayImage' => 'overlay.jpg'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,oi-overlay.jpg/default-image.jpg',
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
                    'overlayImage' => '/path/to/overlay.jpg'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,oi-path@@to@@overlay.jpg/default-image.jpg',
            $url
        );
    }

    /**
     *
     */
    public function testUrlOverLayX()
    {
        $url = $this->client->url([
            'path' => '/default-image.jpg',
            'transformation' => [
                [
                    'height' => 300,
                    'width' => 400,
                    'overlayX' => 10
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,ox-10/default-image.jpg',
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
                    'overlayX' => 35,
                    'overlayY' => 35,
                    'overlayFocus' => 'bottom',
                    'overlayHeight' => 20,
                    'overlayWidth' => 20,
                    'overlayImage' => '/folder/file.jpg', // leading slash case
                    'overlayImageTrim' => false,
                    'overlayImageAspectRatio' => '4:3',
                    'overlayImageBackground' => '0F0F0F',
                    'overlayImageBorder' => '10_0F0F0F',
                    'overlayImageDPR' => 2,
                    'overlayImageQuality' => 50,
                    'overlayImageCropping' => 'force',
                    'overlayText' => 'two words',
                    'overlayTextFontSize' => 20,
                    'overlayTextFontFamily' => 'Open Sans',
                    'overlayTextColor' => '00FFFF',
                    'overlayTextTransparency' => 5,
                    'overlayTextTypography' => 'b',
                    'overlayBackground' => '00AAFF55',
                    'overlayTextEncoded' => 'b3ZlcmxheSBtYWRlIGVhc3k%3D',
                    'overlayTextWidth' => 50,
                    'overlayTextBackground' => '00AAFF55',
                    'overlayTextPadding' => 40,
                    'overlayTextInnerAlignment' => 'left',
                    'overlayRadius' => 10,
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
                    'original' => true,
                    'overlayImageFocus' => 'face'
                ]
            ]
        ]);

        UrlTest::assertEquals(
            'https://ik.imagekit.io/demo/tr:h-300,w-400,ar-4-3,q-40,c-force,cm-extract,fo-left,f-jpeg,r-50,bg-A94D34,b-5-A94D34,rt-90,bl-10,n-some_name,ox-35,oy-35,ofo-bottom,oh-20,ow-20,oi-folder@@file.jpg,oit-false,oiar-4:3,oibg-0F0F0F,oib-10_0F0F0F,oidpr-2,oiq-50,oic-force,ot-two words,ots-20,otf-Open Sans,otc-00FFFF,oa-5,ott-b,obg-00AAFF55,ote-b3ZlcmxheSBtYWRlIGVhc3k%3D,otw-50,otbg-00AAFF55,otp-40,otia-left,or-10,pr-true,lo-true,t-5,md-true,cp-true,di-folder@@file.jpg,dpr-3,e-sharpen-10,e-usm-2-2-0.8-0.024,e-contrast-true,e-grayscale-true,orig-true,oifo-face/default-image.jpg',
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

        UrlTest::assertEquals('Invalid URL provided in the request', json_decode($url)->error->message);

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
