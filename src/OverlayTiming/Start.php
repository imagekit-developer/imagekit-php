<?php

declare(strict_types=1);

namespace Imagekit\OverlayTiming;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Specifies the start time (in seconds) for when the overlay should appear on the base video.
 * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
 * Applies only if the base asset is a video.
 * Maps to `lso` in the URL.
 *
 * @phpstan-type StartShape = float|string
 */
final class Start implements ConverterSource
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
