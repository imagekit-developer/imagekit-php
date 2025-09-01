<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the inner alignment of the text when width is more than the text length.
 */
final class InnerAlignment implements ConverterSource
{
    use SdkEnum;

    public const LEFT = 'left';

    public const RIGHT = 'right';

    public const CENTER = 'center';
}
