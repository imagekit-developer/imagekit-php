<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\OverlayPosition\Focus;

/**
 * @phpstan-import-type XVariants from \Imagekit\OverlayPosition\X
 * @phpstan-import-type YVariants from \Imagekit\OverlayPosition\Y
 * @phpstan-import-type XShape from \Imagekit\OverlayPosition\X
 * @phpstan-import-type YShape from \Imagekit\OverlayPosition\Y
 *
 * @phpstan-type OverlayPositionShape = array{
 *   focus?: null|Focus|value-of<Focus>, x?: XShape|null, y?: YShape|null
 * }
 */
final class OverlayPosition implements BaseModel
{
    /** @use SdkModel<OverlayPositionShape> */
    use SdkModel;

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * Maps to `lfo` in the URL.
     *
     * @var value-of<Focus>|null $focus
     */
    #[Optional(enum: Focus::class)]
    public ?string $focus;

    /**
     * Specifies the x-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lx` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var XVariants|null $x
     */
    #[Optional]
    public float|string|null $x;

    /**
     * Specifies the y-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `ly` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var YVariants|null $y
     */
    #[Optional]
    public float|string|null $y;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Focus|value-of<Focus>|null $focus
     * @param XShape|null $x
     * @param YShape|null $y
     */
    public static function with(
        Focus|string|null $focus = null,
        float|string|null $x = null,
        float|string|null $y = null
    ): self {
        $self = new self;

        null !== $focus && $self['focus'] = $focus;
        null !== $x && $self['x'] = $x;
        null !== $y && $self['y'] = $y;

        return $self;
    }

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * Maps to `lfo` in the URL.
     *
     * @param Focus|value-of<Focus> $focus
     */
    public function withFocus(Focus|string $focus): self
    {
        $self = clone $this;
        $self['focus'] = $focus;

        return $self;
    }

    /**
     * Specifies the x-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lx` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param XShape $x
     */
    public function withX(float|string $x): self
    {
        $self = clone $this;
        $self['x'] = $x;

        return $self;
    }

    /**
     * Specifies the y-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `ly` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param YShape $y
     */
    public function withY(float|string $y): self
    {
        $self = clone $this;
        $self['y'] = $y;

        return $self;
    }
}
