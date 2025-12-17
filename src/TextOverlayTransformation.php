<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\TextOverlayTransformation\Flip;
use Imagekit\TextOverlayTransformation\InnerAlignment;

/**
 * @phpstan-import-type FontSizeShape from \Imagekit\TextOverlayTransformation\FontSize
 * @phpstan-import-type LineHeightShape from \Imagekit\TextOverlayTransformation\LineHeight
 * @phpstan-import-type PaddingShape from \Imagekit\TextOverlayTransformation\Padding
 * @phpstan-import-type RadiusShape from \Imagekit\TextOverlayTransformation\Radius
 * @phpstan-import-type RotationShape from \Imagekit\TextOverlayTransformation\Rotation
 * @phpstan-import-type WidthShape from \Imagekit\TextOverlayTransformation\Width
 *
 * @phpstan-type TextOverlayTransformationShape = array{
 *   alpha?: float|null,
 *   background?: string|null,
 *   flip?: null|Flip|value-of<Flip>,
 *   fontColor?: string|null,
 *   fontFamily?: string|null,
 *   fontSize?: FontSizeShape|null,
 *   innerAlignment?: null|InnerAlignment|value-of<InnerAlignment>,
 *   lineHeight?: LineHeightShape|null,
 *   padding?: PaddingShape|null,
 *   radius?: RadiusShape|null,
 *   rotation?: RotationShape|null,
 *   typography?: string|null,
 *   width?: WidthShape|null,
 * }
 */
final class TextOverlayTransformation implements BaseModel
{
    /** @use SdkModel<TextOverlayTransformationShape> */
    use SdkModel;

    /**
     * Specifies the transparency level of the text overlay. Accepts integers from `1` to `9`.
     */
    #[Optional]
    public ?float $alpha;

    /**
     * Specifies the background color of the text overlay.
     * Accepts an RGB hex code, an RGBA code, or a color name.
     */
    #[Optional]
    public ?string $background;

    /**
     * Flip the text overlay horizontally, vertically, or both.
     *
     * @var value-of<Flip>|null $flip
     */
    #[Optional(enum: Flip::class)]
    public ?string $flip;

    /**
     * Specifies the font color of the overlaid text. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    #[Optional]
    public ?string $fontColor;

    /**
     * Specifies the font family of the overlaid text. Choose from the supported fonts list or use a custom font.
     * See [Supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list) and [Custom font](https://imagekit.io/docs/add-overlays-on-images#change-font-family-in-text-overlay).
     */
    #[Optional]
    public ?string $fontFamily;

    /**
     * Specifies the font size of the overlaid text. Accepts a numeric value or an arithmetic expression.
     */
    #[Optional]
    public float|string|null $fontSize;

    /**
     * Specifies the inner alignment of the text when width is more than the text length.
     *
     * @var value-of<InnerAlignment>|null $innerAlignment
     */
    #[Optional(enum: InnerAlignment::class)]
    public ?string $innerAlignment;

    /**
     * Specifies the line height of the text overlay.
     * Accepts integer values representing line height in points. It can also accept [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations) such as `bw_mul_0.2`, or `bh_div_20`.
     */
    #[Optional]
    public float|string|null $lineHeight;

    /**
     * Specifies the padding around the overlaid text.
     * Can be provided as a single positive integer or multiple values separated by underscores (following CSS shorthand order).
     * Arithmetic expressions are also accepted.
     */
    #[Optional]
    public float|string|null $padding;

    /**
     * Specifies the corner radius of the text overlay.
     * Set to `max` to achieve a circular or oval shape.
     *
     * @var float|'max'|null $radius
     */
    #[Optional]
    public float|string|null $radius;

    /**
     * Specifies the rotation angle of the text overlay.
     * Accepts a numeric value for clockwise rotation or a string prefixed with "N" for counter-clockwise rotation.
     */
    #[Optional]
    public float|string|null $rotation;

    /**
     * Specifies the typography style of the text.
     * Supported values:
     *   - Single styles: `b` (bold), `i` (italic), `strikethrough`.
     *   - Combinations: Any combination separated by underscores, e.g., `b_i`, `b_i_strikethrough`.
     */
    #[Optional]
    public ?string $typography;

    /**
     * Specifies the maximum width (in pixels) of the overlaid text. The text wraps automatically, and arithmetic expressions (e.g., `bw_mul_0.2` or `bh_div_2`) are supported. Useful when used in conjunction with the `background`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
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
     * @param Flip|value-of<Flip>|null $flip
     * @param FontSizeShape|null $fontSize
     * @param InnerAlignment|value-of<InnerAlignment>|null $innerAlignment
     * @param LineHeightShape|null $lineHeight
     * @param PaddingShape|null $padding
     * @param RadiusShape|null $radius
     * @param RotationShape|null $rotation
     * @param WidthShape|null $width
     */
    public static function with(
        ?float $alpha = null,
        ?string $background = null,
        Flip|string|null $flip = null,
        ?string $fontColor = null,
        ?string $fontFamily = null,
        float|string|null $fontSize = null,
        InnerAlignment|string|null $innerAlignment = null,
        float|string|null $lineHeight = null,
        float|string|null $padding = null,
        float|string|null $radius = null,
        float|string|null $rotation = null,
        ?string $typography = null,
        float|string|null $width = null,
    ): self {
        $self = new self;

        null !== $alpha && $self['alpha'] = $alpha;
        null !== $background && $self['background'] = $background;
        null !== $flip && $self['flip'] = $flip;
        null !== $fontColor && $self['fontColor'] = $fontColor;
        null !== $fontFamily && $self['fontFamily'] = $fontFamily;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $innerAlignment && $self['innerAlignment'] = $innerAlignment;
        null !== $lineHeight && $self['lineHeight'] = $lineHeight;
        null !== $padding && $self['padding'] = $padding;
        null !== $radius && $self['radius'] = $radius;
        null !== $rotation && $self['rotation'] = $rotation;
        null !== $typography && $self['typography'] = $typography;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Specifies the transparency level of the text overlay. Accepts integers from `1` to `9`.
     */
    public function withAlpha(float $alpha): self
    {
        $self = clone $this;
        $self['alpha'] = $alpha;

        return $self;
    }

    /**
     * Specifies the background color of the text overlay.
     * Accepts an RGB hex code, an RGBA code, or a color name.
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Flip the text overlay horizontally, vertically, or both.
     *
     * @param Flip|value-of<Flip> $flip
     */
    public function withFlip(Flip|string $flip): self
    {
        $self = clone $this;
        $self['flip'] = $flip;

        return $self;
    }

    /**
     * Specifies the font color of the overlaid text. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    public function withFontColor(string $fontColor): self
    {
        $self = clone $this;
        $self['fontColor'] = $fontColor;

        return $self;
    }

    /**
     * Specifies the font family of the overlaid text. Choose from the supported fonts list or use a custom font.
     * See [Supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list) and [Custom font](https://imagekit.io/docs/add-overlays-on-images#change-font-family-in-text-overlay).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $self = clone $this;
        $self['fontFamily'] = $fontFamily;

        return $self;
    }

    /**
     * Specifies the font size of the overlaid text. Accepts a numeric value or an arithmetic expression.
     *
     * @param FontSizeShape $fontSize
     */
    public function withFontSize(float|string $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
    }

    /**
     * Specifies the inner alignment of the text when width is more than the text length.
     *
     * @param InnerAlignment|value-of<InnerAlignment> $innerAlignment
     */
    public function withInnerAlignment(
        InnerAlignment|string $innerAlignment
    ): self {
        $self = clone $this;
        $self['innerAlignment'] = $innerAlignment;

        return $self;
    }

    /**
     * Specifies the line height of the text overlay.
     * Accepts integer values representing line height in points. It can also accept [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations) such as `bw_mul_0.2`, or `bh_div_20`.
     *
     * @param LineHeightShape $lineHeight
     */
    public function withLineHeight(float|string $lineHeight): self
    {
        $self = clone $this;
        $self['lineHeight'] = $lineHeight;

        return $self;
    }

    /**
     * Specifies the padding around the overlaid text.
     * Can be provided as a single positive integer or multiple values separated by underscores (following CSS shorthand order).
     * Arithmetic expressions are also accepted.
     *
     * @param PaddingShape $padding
     */
    public function withPadding(float|string $padding): self
    {
        $self = clone $this;
        $self['padding'] = $padding;

        return $self;
    }

    /**
     * Specifies the corner radius of the text overlay.
     * Set to `max` to achieve a circular or oval shape.
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
     * Specifies the rotation angle of the text overlay.
     * Accepts a numeric value for clockwise rotation or a string prefixed with "N" for counter-clockwise rotation.
     *
     * @param RotationShape $rotation
     */
    public function withRotation(float|string $rotation): self
    {
        $self = clone $this;
        $self['rotation'] = $rotation;

        return $self;
    }

    /**
     * Specifies the typography style of the text.
     * Supported values:
     *   - Single styles: `b` (bold), `i` (italic), `strikethrough`.
     *   - Combinations: Any combination separated by underscores, e.g., `b_i`, `b_i_strikethrough`.
     */
    public function withTypography(string $typography): self
    {
        $self = clone $this;
        $self['typography'] = $typography;

        return $self;
    }

    /**
     * Specifies the maximum width (in pixels) of the overlaid text. The text wraps automatically, and arithmetic expressions (e.g., `bw_mul_0.2` or `bh_div_2`) are supported. Useful when used in conjunction with the `background`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
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
