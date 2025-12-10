<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointRequest;

use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\AkamaiURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\CloudinaryURLRewriter;
use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\ImgixURLRewriter;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Configuration for third-party URL rewriting.
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
