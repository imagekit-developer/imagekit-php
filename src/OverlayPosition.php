<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\OverlayPosition\Focus;

/**
 * @phpstan-type overlay_position = array{
 *   focus?: value-of<Focus>, x?: float|string, y?: float|string
 * }
 */
final class OverlayPosition implements BaseModel
{
    /** @use SdkModel<overlay_position> */
    use SdkModel;

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * Maps to `lfo` in the URL.
     *
     * @var value-of<Focus>|null $focus
     */
    #[Api(enum: Focus::class, optional: true)]
    public ?string $focus;

    /**
     * Specifies the x-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lx` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    #[Api(optional: true)]
    public float|string|null $x;

    /**
     * Specifies the y-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `ly` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    #[Api(optional: true)]
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
     * @param Focus|value-of<Focus> $focus
     */
    public static function with(
        Focus|string|null $focus = null,
        float|string|null $x = null,
        float|string|null $y = null
    ): self {
        $obj = new self;

        null !== $focus && $obj['focus'] = $focus;
        null !== $x && $obj->x = $x;
        null !== $y && $obj->y = $y;

        return $obj;
    }

    /**
     * Specifies the position of the overlay relative to the parent image or video.
     * Maps to `lfo` in the URL.
     *
     * @param Focus|value-of<Focus> $focus
     */
    public function withFocus(Focus|string $focus): self
    {
        $obj = clone $this;
        $obj['focus'] = $focus;

        return $obj;
    }

    /**
     * Specifies the x-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bw_mul_0.4` or `bw_sub_cw`.
     * Maps to `lx` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    public function withX(float|string $x): self
    {
        $obj = clone $this;
        $obj->x = $x;

        return $obj;
    }

    /**
     * Specifies the y-coordinate of the top-left corner of the base asset where the overlay's top-left corner will be positioned.
     * It also accepts arithmetic expressions such as `bh_mul_0.4` or `bh_sub_ch`.
     * Maps to `ly` in the URL.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    public function withY(float|string $y): self
    {
        $obj = clone $this;
        $obj->y = $y;

        return $obj;
    }
}
