<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Generates a thumbnail image.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const THUMBNAIL = 'thumbnail';
}
