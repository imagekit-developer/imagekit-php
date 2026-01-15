<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\BaseOverlay\LayerMode;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type OverlayPositionShape from \Imagekit\OverlayPosition
 * @phpstan-import-type OverlayTimingShape from \Imagekit\OverlayTiming
 * @phpstan-import-type SolidColorOverlayTransformationShape from \Imagekit\SolidColorOverlayTransformation
 *
 * @phpstan-type SolidColorOverlayShape = array{
 *   layerMode?: null|LayerMode|value-of<LayerMode>,
 *   position?: null|OverlayPosition|OverlayPositionShape,
 *   timing?: null|OverlayTiming|OverlayTimingShape,
 *   color: string,
 *   type: 'solidColor',
 *   transformation?: list<SolidColorOverlayTransformation|SolidColorOverlayTransformationShape>|null,
 * }
 */
final class SolidColorOverlay implements BaseModel
{
    /** @use SdkModel<SolidColorOverlayShape> */
    use SdkModel;

    /** @var 'solidColor' $type */
    #[Required]
    public string $type = 'solidColor';

    /**
     * Controls how the layer blends with the base image or underlying content. Maps to `lm` in the URL.
     * By default, layers completely cover the base image beneath them. Layer modes change this behavior:
     * - `multiply`: Multiplies the pixel values of the layer with the base image. The result is always darker than the original images. This is ideal for applying shadows or color tints.
     * - `displace`: Uses the layer as a displacement map to distort pixels in the base image. The red channel controls horizontal displacement, and the green channel controls vertical displacement. Requires `x` or `y` parameter to control displacement magnitude.
     * - `cutout`: Acts as an inverse mask where opaque areas of the layer turn the base image transparent, while transparent areas leave the base image unchanged. This mode functions like a hole-punch, effectively cutting the shape of the layer out of the underlying image.
     * - `cutter`: Acts as a shape mask where only the parts of the base image that fall inside the opaque area of the layer are preserved. This mode functions like a cookie-cutter, trimming the base image to match the specific dimensions and shape of the layer.
     * See [Layer modes](https://imagekit.io/docs/add-overlays-on-images#layer-modes).
     *
     * @var value-of<LayerMode>|null $layerMode
     */
    #[Optional(enum: LayerMode::class)]
    public ?string $layerMode;

    #[Optional]
    public ?OverlayPosition $position;

    #[Optional]
    public ?OverlayTiming $timing;

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    #[Required]
    public string $color;

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @var list<SolidColorOverlayTransformation>|null $transformation
     */
    #[Optional(list: SolidColorOverlayTransformation::class)]
    public ?array $transformation;

    /**
     * `new SolidColorOverlay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SolidColorOverlay::with(color: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SolidColorOverlay)->withColor(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LayerMode|value-of<LayerMode>|null $layerMode
     * @param OverlayPosition|OverlayPositionShape|null $position
     * @param OverlayTiming|OverlayTimingShape|null $timing
     * @param list<SolidColorOverlayTransformation|SolidColorOverlayTransformationShape>|null $transformation
     */
    public static function with(
        string $color,
        LayerMode|string|null $layerMode = null,
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null,
        ?array $transformation = null,
    ): self {
        $self = new self;

        $self['color'] = $color;

        null !== $layerMode && $self['layerMode'] = $layerMode;
        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;
        null !== $transformation && $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * Controls how the layer blends with the base image or underlying content. Maps to `lm` in the URL.
     * By default, layers completely cover the base image beneath them. Layer modes change this behavior:
     * - `multiply`: Multiplies the pixel values of the layer with the base image. The result is always darker than the original images. This is ideal for applying shadows or color tints.
     * - `displace`: Uses the layer as a displacement map to distort pixels in the base image. The red channel controls horizontal displacement, and the green channel controls vertical displacement. Requires `x` or `y` parameter to control displacement magnitude.
     * - `cutout`: Acts as an inverse mask where opaque areas of the layer turn the base image transparent, while transparent areas leave the base image unchanged. This mode functions like a hole-punch, effectively cutting the shape of the layer out of the underlying image.
     * - `cutter`: Acts as a shape mask where only the parts of the base image that fall inside the opaque area of the layer are preserved. This mode functions like a cookie-cutter, trimming the base image to match the specific dimensions and shape of the layer.
     * See [Layer modes](https://imagekit.io/docs/add-overlays-on-images#layer-modes).
     *
     * @param LayerMode|value-of<LayerMode> $layerMode
     */
    public function withLayerMode(LayerMode|string $layerMode): self
    {
        $self = clone $this;
        $self['layerMode'] = $layerMode;

        return $self;
    }

    /**
     * @param OverlayPosition|OverlayPositionShape $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * @param OverlayTiming|OverlayTimingShape $timing
     */
    public function withTiming(OverlayTiming|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }

    /**
     * Specifies the color of the block using an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name (e.g., `red`).
     * If an 8-character value is provided, the last two characters represent the opacity level (from `00` for 0.00 to `99` for 0.99).
     */
    public function withColor(string $color): self
    {
        $self = clone $this;
        $self['color'] = $color;

        return $self;
    }

    /**
     * Control width and height of the solid color overlay. Supported transformations depend on the base/parent asset.
     * See overlays on [Images](https://imagekit.io/docs/add-overlays-on-images#apply-transformation-on-solid-color-overlay) and [Videos](https://imagekit.io/docs/add-overlays-on-videos#apply-transformations-on-solid-color-block-overlay).
     *
     * @param list<SolidColorOverlayTransformation|SolidColorOverlayTransformationShape> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
