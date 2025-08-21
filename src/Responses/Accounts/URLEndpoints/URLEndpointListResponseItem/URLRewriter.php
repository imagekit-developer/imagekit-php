<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\AkamaiURLRewriter;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem\URLRewriter\ImgixURLRewriter;

/**
 * Configuration for third-party URL rewriting.
 *
 * @phpstan-type url_rewriter_alias = CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter
 */
final class URLRewriter implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [
            CloudinaryURLRewriter::class,
            ImgixURLRewriter::class,
            AkamaiURLRewriter::class,
        ];
    }
}
