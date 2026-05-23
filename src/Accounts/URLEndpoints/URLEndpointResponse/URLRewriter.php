<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointResponse;

use ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\ImgixURLRewriter;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Configuration for third-party URL rewriting.
 *
 * @phpstan-import-type CloudinaryURLRewriterShape from \ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\CloudinaryURLRewriter
 * @phpstan-import-type ImgixURLRewriterShape from \ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\ImgixURLRewriter
 * @phpstan-import-type AkamaiURLRewriterShape from \ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter\AkamaiURLRewriter
 *
 * @phpstan-type URLRewriterVariants = CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter
 * @phpstan-type URLRewriterShape = URLRewriterVariants|CloudinaryURLRewriterShape|ImgixURLRewriterShape|AkamaiURLRewriterShape
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
