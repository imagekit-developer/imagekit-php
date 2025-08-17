<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post\SimplePostTransformation;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Transformation type.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const TRANSFORMATION = 'transformation';
}
