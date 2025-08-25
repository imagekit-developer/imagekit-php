<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointRequest;

use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Akamai;
use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Cloudinary;
use ImageKit\Accounts\URLEndpoints\URLEndpointRequest\URLRewriter\Imgix;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

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
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
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
