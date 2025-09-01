<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type solid_color_overlay_transformation = array{
 *   alpha?: float|null,
 *   background?: string|null,
 *   gradient?: bool|string|null,
 *   height?: float|string|null,
 *   radius?: float|string|null,
 *   width?: float|string|null,
 * }
 */
final class SolidColorOverlayTransformation implements BaseModel
{
    /** @use SdkModel<solid_color_overlay_transformation> */
    use SdkModel;

    /**
     * Specifies the transparency level of the solid color overlay. Accepts integers from `1` to `9`.
     */
    #[Api(optional: true)]
    public ?float $alpha;

    /**
     * Specifies the background color of the solid color overlay. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * Only works if the base asset is an image. See [gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    #[Api(optional: true)]
    public bool|string|null $gradient;

    /**
     * Controls the height of the solid color overlay. Accepts a numeric value or an arithmetic expression.
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    #[Api(optional: true)]
    public float|string|null $height;

    /**
     * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
     * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     */
    #[Api(optional: true)]
    public float|string|null $radius;

    /**
     * Controls the width of the solid color overlay. Accepts a numeric value or an arithmetic expression (e.g., `bw_mul_0.2` or `bh_div_2`).
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    #[Api(optional: true)]
    public float|string|null $width;

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
        ?float $alpha = null,
        ?string $background = null,
        bool|string|null $gradient = null,
        float|string|null $height = null,
        float|string|null $radius = null,
        float|string|null $width = null,
    ): self {
        $obj = new self;

        null !== $alpha && $obj->alpha = $alpha;
        null !== $background && $obj->background = $background;
        null !== $gradient && $obj->gradient = $gradient;
        null !== $height && $obj->height = $height;
        null !== $radius && $obj->radius = $radius;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * Specifies the transparency level of the solid color overlay. Accepts integers from `1` to `9`.
     */
    public function withAlpha(float $alpha): self
    {
        $obj = clone $this;
        $obj->alpha = $alpha;

        return $obj;
    }

    /**
     * Specifies the background color of the solid color overlay. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    public function withBackground(string $background): self
    {
        $obj = clone $this;
        $obj->background = $background;

        return $obj;
    }

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * Only works if the base asset is an image. See [gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     */
    public function withGradient(bool|string $gradient): self
    {
        $obj = clone $this;
        $obj->gradient = $gradient;

        return $obj;
    }

    /**
     * Controls the height of the solid color overlay. Accepts a numeric value or an arithmetic expression.
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    public function withHeight(float|string $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
     * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     */
    public function withRadius(float|string $radius): self
    {
        $obj = clone $this;
        $obj->radius = $radius;

        return $obj;
    }

    /**
     * Controls the width of the solid color overlay. Accepts a numeric value or an arithmetic expression (e.g., `bw_mul_0.2` or `bh_div_2`).
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    public function withWidth(float|string $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
