<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;
use ImageKit\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;

/**
 * @phpstan-type post_alias = SimplePostTransformation|ConvertGifToVideo|GenerateAThumbnail|AdaptiveBitrateStreaming
 */
final class Post implements ConverterSource
{
    use SdkUnion;

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
