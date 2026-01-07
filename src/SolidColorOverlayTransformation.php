<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type GradientVariants from \Imagekit\SolidColorOverlayTransformation\Gradient
 * @phpstan-import-type HeightVariants from \Imagekit\SolidColorOverlayTransformation\Height
 * @phpstan-import-type RadiusVariants from \Imagekit\SolidColorOverlayTransformation\Radius
 * @phpstan-import-type WidthVariants from \Imagekit\SolidColorOverlayTransformation\Width
 * @phpstan-import-type GradientShape from \Imagekit\SolidColorOverlayTransformation\Gradient
 * @phpstan-import-type HeightShape from \Imagekit\SolidColorOverlayTransformation\Height
 * @phpstan-import-type RadiusShape from \Imagekit\SolidColorOverlayTransformation\Radius
 * @phpstan-import-type WidthShape from \Imagekit\SolidColorOverlayTransformation\Width
 *
 * @phpstan-type SolidColorOverlayTransformationShape = array{
 *   alpha?: float|null,
 *   background?: string|null,
 *   gradient?: GradientShape|null,
 *   height?: HeightShape|null,
 *   radius?: RadiusShape|null,
 *   width?: WidthShape|null,
 * }
 */
final class SolidColorOverlayTransformation implements BaseModel
{
    /** @use SdkModel<SolidColorOverlayTransformationShape> */
    use SdkModel;

    /**
     * Specifies the transparency level of the solid color overlay. Accepts integers from `1` to `9`.
     */
    #[Optional]
    public ?float $alpha;

    /**
     * Specifies the background color of the solid color overlay. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    #[Optional]
    public ?string $background;

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * Only works if the base asset is an image. See [gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     *
     * @var GradientVariants|null $gradient
     */
    #[Optional]
    public string|bool|null $gradient;

    /**
     * Controls the height of the solid color overlay. Accepts a numeric value or an arithmetic expression.
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var HeightVariants|null $height
     */
    #[Optional]
    public float|string|null $height;

    /**
     * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
     * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     *
     * @var RadiusVariants|null $radius
     */
    #[Optional]
    public float|string|null $radius;

    /**
     * Controls the width of the solid color overlay. Accepts a numeric value or an arithmetic expression (e.g., `bw_mul_0.2` or `bh_div_2`).
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @var WidthVariants|null $width
     */
    #[Optional]
    public float|string|null $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param GradientShape|null $gradient
     * @param HeightShape|null $height
     * @param RadiusShape|null $radius
     * @param WidthShape|null $width
     */
    public static function with(
        ?float $alpha = null,
        ?string $background = null,
        string|bool|null $gradient = null,
        float|string|null $height = null,
        float|string|null $radius = null,
        float|string|null $width = null,
    ): self {
        $self = new self;

        null !== $alpha && $self['alpha'] = $alpha;
        null !== $background && $self['background'] = $background;
        null !== $gradient && $self['gradient'] = $gradient;
        null !== $height && $self['height'] = $height;
        null !== $radius && $self['radius'] = $radius;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Specifies the transparency level of the solid color overlay. Accepts integers from `1` to `9`.
     */
    public function withAlpha(float $alpha): self
    {
        $self = clone $this;
        $self['alpha'] = $alpha;

        return $self;
    }

    /**
     * Specifies the background color of the solid color overlay. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Creates a linear gradient with two colors. Pass `true` for a default gradient, or provide a string for a custom gradient.
     * Only works if the base asset is an image. See [gradient](https://imagekit.io/docs/effects-and-enhancements#gradient---e-gradient).
     *
     * @param GradientShape $gradient
     */
    public function withGradient(string|bool $gradient): self
    {
        $self = clone $this;
        $self['gradient'] = $gradient;

        return $self;
    }

    /**
     * Controls the height of the solid color overlay. Accepts a numeric value or an arithmetic expression.
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param HeightShape $height
     */
    public function withHeight(float|string $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Specifies the corner radius of the solid color overlay. Set to `max` for circular or oval shape.
     * See [radius](https://imagekit.io/docs/effects-and-enhancements#radius---r).
     *
     * @param RadiusShape $radius
     */
    public function withRadius(float|string $radius): self
    {
        $self = clone $this;
        $self['radius'] = $radius;

        return $self;
    }

    /**
     * Controls the width of the solid color overlay. Accepts a numeric value or an arithmetic expression (e.g., `bw_mul_0.2` or `bh_div_2`).
     * Learn about [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     *
     * @param WidthShape $width
     */
    public function withWidth(float|string $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
