<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\BaseOverlay\LayerMode;
use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\TextOverlay\Encoding;

/**
 * @phpstan-import-type OverlayPositionShape from \Imagekit\OverlayPosition
 * @phpstan-import-type OverlayTimingShape from \Imagekit\OverlayTiming
 * @phpstan-import-type TextOverlayTransformationShape from \Imagekit\TextOverlayTransformation
 *
 * @phpstan-type TextOverlayShape = array{
 *   layerMode?: null|LayerMode|value-of<LayerMode>,
 *   position?: null|OverlayPosition|OverlayPositionShape,
 *   timing?: null|OverlayTiming|OverlayTimingShape,
 *   text: string,
 *   type: 'text',
 *   encoding?: null|Encoding|value-of<Encoding>,
 *   transformation?: list<TextOverlayTransformation|TextOverlayTransformationShape>|null,
 * }
 */
final class TextOverlay implements BaseModel
{
    /** @use SdkModel<TextOverlayShape> */
    use SdkModel;

    /** @var 'text' $type */
    #[Required]
    public string $type = 'text';

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
     * Specifies the text to be displayed in the overlay. The SDK automatically handles special characters and encoding.
     */
    #[Required]
    public string $text;

    /**
     * Text can be included in the layer as either `i-{input}` (plain text) or `ie-{base64_encoded_input}` (base64).
     * By default, the SDK selects the appropriate format based on the input text.
     * To always use base64 (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * Regardless of the encoding method, the input text is always percent-encoded to ensure it is URL-safe.
     *
     * @var value-of<Encoding>|null $encoding
     */
    #[Optional(enum: Encoding::class)]
    public ?string $encoding;

    /**
     * Control styling of the text overlay. See [Text overlays](https://imagekit.io/docs/add-overlays-on-images#text-overlay).
     *
     * @var list<TextOverlayTransformation>|null $transformation
     */
    #[Optional(list: TextOverlayTransformation::class)]
    public ?array $transformation;

    /**
     * `new TextOverlay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TextOverlay::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TextOverlay)->withText(...)
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
     * @param Encoding|value-of<Encoding>|null $encoding
     * @param list<TextOverlayTransformation|TextOverlayTransformationShape>|null $transformation
     */
    public static function with(
        string $text,
        LayerMode|string|null $layerMode = null,
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null,
        Encoding|string|null $encoding = null,
        ?array $transformation = null,
    ): self {
        $self = new self;

        $self['text'] = $text;

        null !== $layerMode && $self['layerMode'] = $layerMode;
        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;
        null !== $encoding && $self['encoding'] = $encoding;
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
     * Specifies the text to be displayed in the overlay. The SDK automatically handles special characters and encoding.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * @param 'text' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Text can be included in the layer as either `i-{input}` (plain text) or `ie-{base64_encoded_input}` (base64).
     * By default, the SDK selects the appropriate format based on the input text.
     * To always use base64 (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * Regardless of the encoding method, the input text is always percent-encoded to ensure it is URL-safe.
     *
     * @param Encoding|value-of<Encoding> $encoding
     */
    public function withEncoding(Encoding|string $encoding): self
    {
        $self = clone $this;
        $self['encoding'] = $encoding;

        return $self;
    }

    /**
     * Control styling of the text overlay. See [Text overlays](https://imagekit.io/docs/add-overlays-on-images#text-overlay).
     *
     * @param list<TextOverlayTransformation|TextOverlayTransformationShape> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
