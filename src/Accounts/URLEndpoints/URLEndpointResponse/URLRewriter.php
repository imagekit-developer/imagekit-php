<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointResponse;

use Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\AkamaiURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\CloudinaryURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\ImgixURLRewriter;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Configuration for third-party URL rewriting.
 *
 * @phpstan-import-type CloudinaryURLRewriterShape from \Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\CloudinaryURLRewriter
 * @phpstan-import-type ImgixURLRewriterShape from \Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\ImgixURLRewriter
 * @phpstan-import-type AkamaiURLRewriterShape from \Imagekit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\AkamaiURLRewriter
 *
 * @phpstan-type URLRewriterShape = CloudinaryURLRewriterShape|ImgixURLRewriterShape|AkamaiURLRewriterShape
 */
final class URLRewriter implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'CLOUDINARY' => CloudinaryURLRewriter::class,
            'IMGIX' => ImgixURLRewriter::class,
            'AKAMAI' => AkamaiURLRewriter::class,
        ];
    }
}
