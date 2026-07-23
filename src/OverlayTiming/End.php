<?php

declare(strict_types=1);

namespace ImageKit\OverlayTiming;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the end time (in seconds) for when the overlay should disappear from the base video.
 * If both end and duration are provided, duration is ignored.
 * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
 * Applies only if the base asset is a video.
 * Maps to `leo` in the URL.
 *
 * @phpstan-type EndVariants = float|string
 * @phpstan-type EndShape = EndVariants
 */
final class End implements ConverterSource
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
