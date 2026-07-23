<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies an overlay to be applied on the parent image or video.
 * ImageKit supports overlays including images, text, videos, subtitles, and solid colors.
 * See [Overlay using layers](https://imagekit.io/docs/transformations#overlay-using-layers).
 *
 * @phpstan-import-type TextOverlayShape from \ImageKit\TextOverlay
 * @phpstan-import-type ImageOverlayShape from \ImageKit\ImageOverlay
 * @phpstan-import-type VideoOverlayShape from \ImageKit\VideoOverlay
 * @phpstan-import-type SubtitleOverlayShape from \ImageKit\SubtitleOverlay
 * @phpstan-import-type SolidColorOverlayShape from \ImageKit\SolidColorOverlay
 *
 * @phpstan-type OverlayVariants = mixed|TextOverlay|SubtitleOverlay|SolidColorOverlay
 * @phpstan-type OverlayShape = OverlayVariants|TextOverlayShape|ImageOverlayShape|VideoOverlayShape|SubtitleOverlayShape|SolidColorOverlayShape
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
