<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointRequest;

use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Akamai;
use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Cloudinary;
use Imagekit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Imgix;
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
            'CLOUDINARY' => Cloudinary::class,
            'IMGIX' => Imgix::class,
            'AKAMAI' => Akamai::class,
        ];
    }
}
