<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation;

use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;
use ImageKit\Core\Concerns\Union;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type post_alias = SimplePostTransformation|ConvertGifToVideo|GenerateAThumbnail|AdaptiveBitrateStreaming
 */
final class Post implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [
            SimplePostTransformation::class,
            ConvertGifToVideo::class,
            GenerateAThumbnail::class,
            AdaptiveBitrateStreaming::class,
        ];
    }
}
