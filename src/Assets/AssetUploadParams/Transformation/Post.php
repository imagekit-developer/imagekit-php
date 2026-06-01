<?php

declare(strict_types=1);

namespace ImageKit\Assets\AssetUploadParams\Transformation;

use ImageKit\Assets\AssetUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Assets\AssetUploadParams\Transformation\Post\ConvertGifToVideo;
use ImageKit\Assets\AssetUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Assets\AssetUploadParams\Transformation\Post\SimplePostTransformation;
use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type SimplePostTransformationShape from \ImageKit\Assets\AssetUploadParams\Transformation\Post\SimplePostTransformation
 * @phpstan-import-type ConvertGifToVideoShape from \ImageKit\Assets\AssetUploadParams\Transformation\Post\ConvertGifToVideo
 * @phpstan-import-type GenerateAThumbnailShape from \ImageKit\Assets\AssetUploadParams\Transformation\Post\GenerateAThumbnail
 * @phpstan-import-type AdaptiveBitrateStreamingShape from \ImageKit\Assets\AssetUploadParams\Transformation\Post\AdaptiveBitrateStreaming
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
