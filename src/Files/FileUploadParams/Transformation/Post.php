<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams\Transformation;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;
use Imagekit\Files\FileUploadParams\Transformation\Post\Abs;
use Imagekit\Files\FileUploadParams\Transformation\Post\GifToVideo;
use Imagekit\Files\FileUploadParams\Transformation\Post\Thumbnail;
use Imagekit\Files\FileUploadParams\Transformation\Post\Transformation;

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
