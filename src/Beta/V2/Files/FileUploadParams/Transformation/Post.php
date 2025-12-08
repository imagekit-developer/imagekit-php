<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation;

use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\Abs;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\GifToVideo;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\Thumbnail;
use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\Transformation;
use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

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
