<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type OverlayTimingShape = array{
 *   duration?: float|string|null,
 *   end?: float|string|null,
 *   start?: float|string|null,
 * }
 */
final class OverlayTiming implements BaseModel
{
    /** @use SdkModel<OverlayTimingShape> */
    use SdkModel;

    /**
     * Specifies the duration (in seconds) during which the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `ldu` in the URL.
     */
    #[Api(optional: true)]
    public float|string|null $duration;

    /**
     * Specifies the end time (in seconds) for when the overlay should disappear from the base video.
     * If both end and duration are provided, duration is ignored.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `leo` in the URL.
     */
    #[Api(optional: true)]
    public float|string|null $end;

    /**
     * Specifies the start time (in seconds) for when the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `lso` in the URL.
     */
    #[Api(optional: true)]
    public float|string|null $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        float|string|null $duration = null,
        float|string|null $end = null,
        float|string|null $start = null,
    ): self {
        $obj = new self;

        null !== $duration && $obj['duration'] = $duration;
        null !== $end && $obj['end'] = $end;
        null !== $start && $obj['start'] = $start;

        return $obj;
    }

    /**
     * Specifies the duration (in seconds) during which the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `ldu` in the URL.
     */
    public function withDuration(float|string $duration): self
    {
        $obj = clone $this;
        $obj['duration'] = $duration;

        return $obj;
    }

    /**
     * Specifies the end time (in seconds) for when the overlay should disappear from the base video.
     * If both end and duration are provided, duration is ignored.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `leo` in the URL.
     */
    public function withEnd(float|string $end): self
    {
        $obj = clone $this;
        $obj['end'] = $end;

        return $obj;
    }

    /**
     * Specifies the start time (in seconds) for when the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `lso` in the URL.
     */
    public function withStart(float|string $start): self
    {
        $obj = clone $this;
        $obj['start'] = $start;

        return $obj;
    }
}
