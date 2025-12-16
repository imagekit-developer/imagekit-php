<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use Imagekit\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;
use Imagekit\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use Imagekit\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;

/**
 * @phpstan-import-type SimplePostTransformationShape from \Imagekit\Files\FileUploadParams\Transformation\Post\SimplePostTransformation
 * @phpstan-import-type ConvertGifToVideoShape from \Imagekit\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo
 * @phpstan-import-type GenerateAThumbnailShape from \Imagekit\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail
 * @phpstan-import-type AdaptiveBitrateStreamingShape from \Imagekit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming
 *
 * @phpstan-type PostShape = SimplePostTransformationShape|ConvertGifToVideoShape|GenerateAThumbnailShape|AdaptiveBitrateStreamingShape
 */
final class Post implements ConverterSource
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
            'transformation' => SimplePostTransformation::class,
            'gif-to-video' => ConvertGifToVideo::class,
            'thumbnail' => GenerateAThumbnail::class,
            'abs' => AdaptiveBitrateStreaming::class,
        ];
    }
}
