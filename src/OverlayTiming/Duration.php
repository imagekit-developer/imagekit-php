<?php

declare(strict_types=1);

namespace ImageKit\OverlayTiming;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the duration (in seconds) during which the overlay should appear on the base video.
 * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
 * Applies only if the base asset is a video.
 * Maps to `ldu` in the URL.
 *
 * @phpstan-type DurationVariants = float|string
 * @phpstan-type DurationShape = DurationVariants
 */
final class Duration implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}
