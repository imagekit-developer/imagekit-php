<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\OverlayPosition\AnchorPoint;
use ImageKit\OverlayPosition\Focus;

/**
 * @phpstan-import-type XVariants from \ImageKit\OverlayPosition\X
 * @phpstan-import-type XCenterVariants from \ImageKit\OverlayPosition\XCenter
 * @phpstan-import-type YVariants from \ImageKit\OverlayPosition\Y
 * @phpstan-import-type YCenterVariants from \ImageKit\OverlayPosition\YCenter
 * @phpstan-import-type XShape from \ImageKit\OverlayPosition\X
 * @phpstan-import-type XCenterShape from \ImageKit\OverlayPosition\XCenter
 * @phpstan-import-type YShape from \ImageKit\OverlayPosition\Y
 * @phpstan-import-type YCenterShape from \ImageKit\OverlayPosition\YCenter
 *
 * @phpstan-type OverlayPositionShape = array{
 *   anchorPoint?: null|AnchorPoint|value-of<AnchorPoint>,
 *   focus?: null|Focus|value-of<Focus>,
 *   x?: XShape|null,
 *   xCenter?: XCenterShape|null,
 *   y?: YShape|null,
 *   yCenter?: YCenterShape|null,
 * }
 */
final class OverlayPosition implements BaseModel
{
    /** @use SdkModel<OverlayPositionShape> */
    use SdkModel;

    /**
     * Sets the anchor point on the base asset from which the overlay offset is calculated.
     * The default value is `top_left`.
     * Maps to `lap` in the URL.
     * Can only be used with one or more of `x`, `y`, `xCenter`, or `yCenter`.
     *
     * @var value-of<AnchorPoint>|null $anchorPoint
     */
    #[Optional(enum: AnchorPoint::class)]
    public ?string $anchorPoint;

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * If one or more of `x`, `y`, `xCenter`, or `yCenter` parameters are specified, this parameter is ignored.
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
     * Specifies the x-coordinate on the base asset where the overlay's center will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lxc` in the URL.
     * Cannot be used together with `x`, but can be used with `y`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var XCenterVariants|null $xCenter
     */
    #[Optional]
    public float|string|null $xCenter;

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

    /**
     * Specifies the y-coordinate on the base asset where the overlay's center will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `lyc` in the URL.
     * Cannot be used together with `y`, but can be used with `x`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var YCenterVariants|null $yCenter
     */
    #[Optional]
    public float|string|null $yCenter;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AnchorPoint|value-of<AnchorPoint>|null $anchorPoint
     * @param Focus|value-of<Focus>|null $focus
     * @param XShape|null $x
     * @param XCenterShape|null $xCenter
     * @param YShape|null $y
     * @param YCenterShape|null $yCenter
     */
    public static function with(
        AnchorPoint|string|null $anchorPoint = null,
        Focus|string|null $focus = null,
        float|string|null $x = null,
        float|string|null $xCenter = null,
        float|string|null $y = null,
        float|string|null $yCenter = null,
    ): self {
        $self = new self;

        null !== $anchorPoint && $self['anchorPoint'] = $anchorPoint;
        null !== $focus && $self['focus'] = $focus;
        null !== $x && $self['x'] = $x;
        null !== $xCenter && $self['xCenter'] = $xCenter;
        null !== $y && $self['y'] = $y;
        null !== $yCenter && $self['yCenter'] = $yCenter;

        return $self;
    }

    /**
     * Sets the anchor point on the base asset from which the overlay offset is calculated.
     * The default value is `top_left`.
     * Maps to `lap` in the URL.
     * Can only be used with one or more of `x`, `y`, `xCenter`, or `yCenter`.
     *
     * @param AnchorPoint|value-of<AnchorPoint> $anchorPoint
     */
    public function withAnchorPoint(AnchorPoint|string $anchorPoint): self
    {
        $self = clone $this;
        $self['anchorPoint'] = $anchorPoint;

        return $self;
    }

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * If one or more of `x`, `y`, `xCenter`, or `yCenter` parameters are specified, this parameter is ignored.
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
     * Specifies the x-coordinate on the base asset where the overlay's center will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lxc` in the URL.
     * Cannot be used together with `x`, but can be used with `y`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param XCenterShape $xCenter
     */
    public function withXCenter(float|string $xCenter): self
    {
        $self = clone $this;
        $self['xCenter'] = $xCenter;

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

    /**
     * Specifies the y-coordinate on the base asset where the overlay's center will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `lyc` in the URL.
     * Cannot be used together with `y`, but can be used with `x`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param YCenterShape $yCenter
     */
    public function withYCenter(float|string $yCenter): self
    {
        $self = clone $this;
        $self['yCenter'] = $yCenter;

        return $self;
    }
}
