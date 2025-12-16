<?php

declare(strict_types=1);

namespace Imagekit\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Extracts a specific page or frame from multi-page or layered files (PDF, PSD, AI).
 * For example, specify by number (e.g., `2`), a range (e.g., `3-4` for the 2nd and 3rd layers),
 * or by name (e.g., `name-layer-4` for a PSD layer).
 * See [Thumbnail extraction](https://imagekit.io/docs/vector-and-animated-images#get-thumbnail-from-psd-pdf-ai-eps-and-animated-files).
 *
 * @phpstan-type PageShape = float|string
 */
final class Page implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
