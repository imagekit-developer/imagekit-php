<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Flips or mirrors an image either horizontally, vertically, or both.
 * Acceptable values: `h` (horizontal), `v` (vertical), `h_v` (horizontal and vertical), or `v_h`.
 */
final class Flip implements ConverterSource
{
    use SdkEnum;

    public const H = 'h';

    public const V = 'v';

    public const H_V = 'h_v';

    public const V_H = 'v_h';
}
