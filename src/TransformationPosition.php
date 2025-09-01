<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * By default, the transformation string is added as a query parameter in the URL, e.g., `?tr=w-100,h-100`.
 * If you want to add the transformation string in the path of the URL, set this to `path`.
 * Learn more in the [Transformations guide](https://imagekit.io/docs/transformations).
 */
final class TransformationPosition implements ConverterSource
{
    use SdkEnum;

    public const PATH = 'path';

    public const QUERY = 'query';
}
