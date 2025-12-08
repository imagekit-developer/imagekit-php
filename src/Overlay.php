<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies an overlay to be applied on the parent image or video.
 * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
 * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
 */
final class Overlay implements ConverterSource
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
            'text' => TextOverlay::class,
            'image' => ImageOverlay::class,
            'video' => VideoOverlay::class,
            'subtitle' => SubtitleOverlay::class,
            'solidColor' => SolidColorOverlay::class,
        ];
    }
}
