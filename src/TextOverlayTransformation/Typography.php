<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the typography style of the text.
 * Supported values: `b` for bold, `i` for italics, and `b_i` for bold with italics.
 */
final class Typography implements ConverterSource
{
    use SdkEnum;

    public const B = 'b';

    public const I = 'i';

    public const B_I = 'b_i';
}
