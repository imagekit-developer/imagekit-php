<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Files\FileUploadParams\Transformation\Post\Abs;
use ImageKit\Files\FileUploadParams\Transformation\Post\GifToVideo;
use ImageKit\Files\FileUploadParams\Transformation\Post\Thumbnail;
use ImageKit\Files\FileUploadParams\Transformation\Post\Transformation;

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
            'transformation' => Transformation::class,
            'gif-to-video' => GifToVideo::class,
            'thumbnail' => Thumbnail::class,
            'abs' => Abs::class,
        ];
    }
}
