<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation;

use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type SimplePostTransformationShape from \Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\SimplePostTransformation
 * @phpstan-import-type ConvertGifToVideoShape from \Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo
 * @phpstan-import-type GenerateAThumbnailShape from \Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail
 * @phpstan-import-type AdaptiveBitrateStreamingShape from \Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming
 *
 * @phpstan-type PostVariants = SimplePostTransformation|ConvertGifToVideo|GenerateAThumbnail|AdaptiveBitrateStreaming
 * @phpstan-type PostShape = PostVariants|SimplePostTransformationShape|ConvertGifToVideoShape|GenerateAThumbnailShape|AdaptiveBitrateStreamingShape
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
