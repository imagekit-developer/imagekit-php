<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SolidColorOverlayTransformation\Gradient;
use ImageKit\SolidColorOverlayTransformation\Gradient\UnionMember0;
use ImageKit\SolidColorOverlayTransformation\Radius;
use ImageKit\SolidColorOverlayTransformation\Radius\UnionMember1;

/**
 * @phpstan-type solid_color_overlay_transformation = array{
 *   alpha?: float|null,
 *   background?: string|null,
 *   gradient?: UnionMember0::*|string|null,
 *   height?: float|string|null,
 *   radius?: UnionMember1::*|float|null,
 *   width?: float|string|null,
 * }
 */
final class SolidColorOverlayTransformation implements BaseModel
{
    /** @use SdkModel<solid_color_overlay_transformation> */
    use SdkModel;

    /**
     * Alpha transparency level.
     */
    #[Api(optional: true)]
    public ?float $alpha;

    /**
     * Background color.
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Gradient effect for the overlay.
     *
     * @var UnionMember0::*|string|null $gradient
     */
    #[Api(union: Gradient::class, optional: true)]
    public bool|string|null $gradient;

    /**
     * Height of the solid color overlay.
     */
    #[Api(optional: true)]
    public float|string|null $height;

    /**
     * Corner radius of the solid color overlay.
     *
     * @var UnionMember1::*|float|null $radius
     */
    #[Api(union: Radius::class, optional: true)]
    public string|float|null $radius;

    /**
     * Width of the solid color overlay.
     */
    #[Api(optional: true)]
    public float|string|null $width;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param UnionMember0::*|string $gradient
     * @param UnionMember1::*|float $radius
     */
    public static function with(
        ?float $alpha = null,
        ?string $background = null,
        bool|string|null $gradient = null,
        float|string|null $height = null,
        string|float|null $radius = null,
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
     * Alpha transparency level.
     */
    public function withAlpha(float $alpha): self
    {
        $obj = clone $this;
        $obj->alpha = $alpha;

        return $obj;
    }

    /**
     * Background color.
     */
    public function withBackground(string $background): self
    {
        $obj = clone $this;
        $obj->background = $background;

        return $obj;
    }

    /**
     * Gradient effect for the overlay.
     *
     * @param UnionMember0::*|string $gradient
     */
    public function withGradient(bool|string $gradient): self
    {
        $obj = clone $this;
        $obj->gradient = $gradient;

        return $obj;
    }

    /**
     * Height of the solid color overlay.
     */
    public function withHeight(float|string $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    /**
     * Corner radius of the solid color overlay.
     *
     * @param UnionMember1::*|float $radius
     */
    public function withRadius(string|float $radius): self
    {
        $obj = clone $this;
        $obj->radius = $radius;

        return $obj;
    }

    /**
     * Width of the solid color overlay.
     */
    public function withWidth(float|string $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
