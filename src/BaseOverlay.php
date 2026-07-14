<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\BaseOverlay\LayerMode;
use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type OverlayPositionShape from \ImageKit\OverlayPosition
 * @phpstan-import-type OverlayTimingShape from \ImageKit\OverlayTiming
 *
 * @phpstan-type BaseOverlayShape = array{
 *   layerMode?: null|LayerMode|value-of<LayerMode>,
 *   position?: null|OverlayPosition|OverlayPositionShape,
 *   timing?: null|OverlayTiming|OverlayTimingShape,
 * }
 */
final class BaseOverlay implements BaseModel
{
    /** @use SdkModel<BaseOverlayShape> */
    use SdkModel;

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

    /**
     * Specifies the overlay's position relative to the parent asset.
     * See [Position of Layer](https://imagekit.io/docs/transformations#position-of-layer).
     */
    #[Optional]
    public ?OverlayPosition $position;

    /**
     * Specifies timing information for the overlay (only applicable if the base asset is a video).
     * See [Position of Layer](https://imagekit.io/docs/transformations#position-of-layer).
     */
    #[Optional]
    public ?OverlayTiming $timing;

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
     */
    public static function with(
        LayerMode|string|null $layerMode = null,
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null,
    ): self {
        $self = new self;

        null !== $layerMode && $self['layerMode'] = $layerMode;
        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;

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
     * Specifies the overlay's position relative to the parent asset.
     * See [Position of Layer](https://imagekit.io/docs/transformations#position-of-layer).
     *
     * @param OverlayPosition|OverlayPositionShape $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * Specifies timing information for the overlay (only applicable if the base asset is a video).
     * See [Position of Layer](https://imagekit.io/docs/transformations#position-of-layer).
     *
     * @param OverlayTiming|OverlayTimingShape $timing
     */
    public function withTiming(OverlayTiming|array $timing): self
    {
        $self = clone $this;
        $self['timing'] = $timing;

        return $self;
    }
}
