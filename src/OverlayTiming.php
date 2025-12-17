<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DurationShape from \Imagekit\OverlayTiming\Duration
 * @phpstan-import-type EndShape from \Imagekit\OverlayTiming\End
 * @phpstan-import-type StartShape from \Imagekit\OverlayTiming\Start
 *
 * @phpstan-type OverlayTimingShape = array{
 *   duration?: DurationShape|null, end?: EndShape|null, start?: StartShape|null
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
    #[Optional]
    public float|string|null $duration;

    /**
     * Specifies the end time (in seconds) for when the overlay should disappear from the base video.
     * If both end and duration are provided, duration is ignored.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `leo` in the URL.
     */
    #[Optional]
    public float|string|null $end;

    /**
     * Specifies the start time (in seconds) for when the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `lso` in the URL.
     */
    #[Optional]
    public float|string|null $start;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DurationShape|null $duration
     * @param EndShape|null $end
     * @param StartShape|null $start
     */
    public static function with(
        float|string|null $duration = null,
        float|string|null $end = null,
        float|string|null $start = null,
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $end && $self['end'] = $end;
        null !== $start && $self['start'] = $start;

        return $self;
    }

    /**
     * Specifies the duration (in seconds) during which the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `ldu` in the URL.
     *
     * @param DurationShape $duration
     */
    public function withDuration(float|string $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Specifies the end time (in seconds) for when the overlay should disappear from the base video.
     * If both end and duration are provided, duration is ignored.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `leo` in the URL.
     *
     * @param EndShape $end
     */
    public function withEnd(float|string $end): self
    {
        $self = clone $this;
        $self['end'] = $end;

        return $self;
    }

    /**
     * Specifies the start time (in seconds) for when the overlay should appear on the base video.
     * Accepts a positive number up to two decimal places (e.g., `20` or `20.50`) and arithmetic expressions such as `bdu_mul_0.4` or `bdu_sub_idu`.
     * Applies only if the base asset is a video.
     * Maps to `lso` in the URL.
     *
     * @param StartShape $start
     */
    public function withStart(float|string $start): self
    {
        $self = clone $this;
        $self['start'] = $start;

        return $self;
    }
}
