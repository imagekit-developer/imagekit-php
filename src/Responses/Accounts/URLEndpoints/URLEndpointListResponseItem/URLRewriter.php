<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\Akamai;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\Cloudinary;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\Imgix;

/**
 * Configuration for third-party URL rewriting.
 *
 * @phpstan-type url_rewriter_alias = Cloudinary|Imgix|Akamai
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
