<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams;

use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

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
