<?php

declare(strict_types=1);

namespace ImageKit\TextOverlayTransformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Flip the text overlay horizontally, vertically, or both.
 */
final class Flip implements ConverterSource
{
    use SdkEnum;

    public const H = 'h';

    public const V = 'v';

    public const H_V = 'h_v';

    public const V_H = 'v_h';
}
