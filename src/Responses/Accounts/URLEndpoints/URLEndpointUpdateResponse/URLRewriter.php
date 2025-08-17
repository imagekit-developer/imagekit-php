<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse;

use ImageKit\Core\Concerns\Union;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse\URLRewriter\AkamaiURLRewriter;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse\URLRewriter\ImgixURLRewriter;

/**
 * Configuration for third-party URL rewriting.
 *
 * @phpstan-type url_rewriter_alias = CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter
 */
final class URLRewriter implements ConverterSource
{
    use Union;

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
