<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\TextOverlayTransformation\Flip;
use ImageKit\TextOverlayTransformation\InnerAlignment;

/**
 * @phpstan-type text_overlay_transformation = array{
 *   alpha?: float|null,
 *   background?: string|null,
 *   flip?: value-of<Flip>|null,
 *   fontColor?: string|null,
 *   fontFamily?: string|null,
 *   fontSize?: float|string|null,
 *   innerAlignment?: value-of<InnerAlignment>|null,
 *   lineHeight?: float|string|null,
 *   padding?: float|string|null,
 *   radius?: float|string|null,
 *   rotation?: float|string|null,
 *   typography?: string|null,
 *   width?: float|string|null,
 * }
 */
final class TextOverlayTransformation implements BaseModel
{
    /** @use SdkModel<text_overlay_transformation> */
    use SdkModel;

    /**
     * Specifies the transparency level of the text overlay. Accepts integers from `1` to `9`.
     */
    #[Api(optional: true)]
    public ?float $alpha;

    /**
     * Specifies the background color of the text overlay.
     * Accepts an RGB hex code, an RGBA code, or a color name.
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Flip the text overlay horizontally, vertically, or both.
     *
     * @var value-of<Flip>|null $flip
     */
    #[Api(enum: Flip::class, optional: true)]
    public ?string $flip;

    /**
     * Specifies the font color of the overlaid text. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    #[Api(optional: true)]
    public ?string $fontColor;

    /**
     * Specifies the font family of the overlaid text. Choose from the supported fonts list or use a custom font.
     * See [Supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list) and [Custom font](https://imagekit.io/docs/add-overlays-on-images#change-font-family-in-text-overlay).
     */
    #[Api(optional: true)]
    public ?string $fontFamily;

    /**
     * Specifies the font size of the overlaid text. Accepts a numeric value or an arithmetic expression.
     */
    #[Api(optional: true)]
    public float|string|null $fontSize;

    /**
     * Specifies the inner alignment of the text when width is more than the text length.
     *
     * @var value-of<InnerAlignment>|null $innerAlignment
     */
    #[Api(enum: InnerAlignment::class, optional: true)]
    public ?string $innerAlignment;

    /**
     * Specifies the line height of the text overlay.
     * Accepts integer values representing line height in points. It can also accept [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations) such as `bw_mul_0.2`, or `bh_div_20`.
     */
    #[Api(optional: true)]
    public float|string|null $lineHeight;

    /**
     * Specifies the padding around the overlaid text.
     * Can be provided as a single positive integer or multiple values separated by underscores (following CSS shorthand order).
     * Arithmetic expressions are also accepted.
     */
    #[Api(optional: true)]
    public float|string|null $padding;

    /**
     * Specifies the corner radius of the text overlay.
     * Set to `max` to achieve a circular or oval shape.
     */
    #[Api(optional: true)]
    public float|string|null $radius;

    /**
     * Specifies the rotation angle of the text overlay.
     * Accepts a numeric value for clockwise rotation or a string prefixed with "N" for counter-clockwise rotation.
     */
    #[Api(optional: true)]
    public float|string|null $rotation;

    /**
     * Specifies the typography style of the text.
     * Supported values:
     *   - Single styles: `b` (bold), `i` (italic), `strikethrough`.
     *   - Combinations: Any combination separated by underscores, e.g., `b_i`, `b_i_strikethrough`.
     */
    #[Api(optional: true)]
    public ?string $typography;

    /**
     * Specifies the maximum width (in pixels) of the overlaid text. The text wraps automatically, and arithmetic expressions (e.g., `bw_mul_0.2` or `bh_div_2`) are supported. Useful when used in conjunction with the `background`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
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
     *
     * @param Flip|value-of<Flip> $flip
     * @param InnerAlignment|value-of<InnerAlignment> $innerAlignment
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
        $obj = new self;

        null !== $alpha && $obj->alpha = $alpha;
        null !== $background && $obj->background = $background;
        null !== $flip && $obj->flip = $flip instanceof Flip ? $flip->value : $flip;
        null !== $fontColor && $obj->fontColor = $fontColor;
        null !== $fontFamily && $obj->fontFamily = $fontFamily;
        null !== $fontSize && $obj->fontSize = $fontSize;
        null !== $innerAlignment && $obj->innerAlignment = $innerAlignment instanceof InnerAlignment ? $innerAlignment->value : $innerAlignment;
        null !== $lineHeight && $obj->lineHeight = $lineHeight;
        null !== $padding && $obj->padding = $padding;
        null !== $radius && $obj->radius = $radius;
        null !== $rotation && $obj->rotation = $rotation;
        null !== $typography && $obj->typography = $typography;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    /**
     * Specifies the transparency level of the text overlay. Accepts integers from `1` to `9`.
     */
    public function withAlpha(float $alpha): self
    {
        $obj = clone $this;
        $obj->alpha = $alpha;

        return $obj;
    }

    /**
     * Specifies the background color of the text overlay.
     * Accepts an RGB hex code, an RGBA code, or a color name.
     */
    public function withBackground(string $background): self
    {
        $obj = clone $this;
        $obj->background = $background;

        return $obj;
    }

    /**
     * Flip the text overlay horizontally, vertically, or both.
     *
     * @param Flip|value-of<Flip> $flip
     */
    public function withFlip(Flip|string $flip): self
    {
        $obj = clone $this;
        $obj->flip = $flip instanceof Flip ? $flip->value : $flip;

        return $obj;
    }

    /**
     * Specifies the font color of the overlaid text. Accepts an RGB hex code (e.g., `FF0000`), an RGBA code (e.g., `FFAABB50`), or a color name.
     */
    public function withFontColor(string $fontColor): self
    {
        $obj = clone $this;
        $obj->fontColor = $fontColor;

        return $obj;
    }

    /**
     * Specifies the font family of the overlaid text. Choose from the supported fonts list or use a custom font.
     * See [Supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list) and [Custom font](https://imagekit.io/docs/add-overlays-on-images#change-font-family-in-text-overlay).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $obj = clone $this;
        $obj->fontFamily = $fontFamily;

        return $obj;
    }

    /**
     * Specifies the font size of the overlaid text. Accepts a numeric value or an arithmetic expression.
     */
    public function withFontSize(float|string $fontSize): self
    {
        $obj = clone $this;
        $obj->fontSize = $fontSize;

        return $obj;
    }

    /**
     * Specifies the inner alignment of the text when width is more than the text length.
     *
     * @param InnerAlignment|value-of<InnerAlignment> $innerAlignment
     */
    public function withInnerAlignment(
        InnerAlignment|string $innerAlignment
    ): self {
        $obj = clone $this;
        $obj->innerAlignment = $innerAlignment instanceof InnerAlignment ? $innerAlignment->value : $innerAlignment;

        return $obj;
    }

    /**
     * Specifies the line height of the text overlay.
     * Accepts integer values representing line height in points. It can also accept [arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations) such as `bw_mul_0.2`, or `bh_div_20`.
     */
    public function withLineHeight(float|string $lineHeight): self
    {
        $obj = clone $this;
        $obj->lineHeight = $lineHeight;

        return $obj;
    }

    /**
     * Specifies the padding around the overlaid text.
     * Can be provided as a single positive integer or multiple values separated by underscores (following CSS shorthand order).
     * Arithmetic expressions are also accepted.
     */
    public function withPadding(float|string $padding): self
    {
        $obj = clone $this;
        $obj->padding = $padding;

        return $obj;
    }

    /**
     * Specifies the corner radius of the text overlay.
     * Set to `max` to achieve a circular or oval shape.
     */
    public function withRadius(float|string $radius): self
    {
        $obj = clone $this;
        $obj->radius = $radius;

        return $obj;
    }

    /**
     * Specifies the rotation angle of the text overlay.
     * Accepts a numeric value for clockwise rotation or a string prefixed with "N" for counter-clockwise rotation.
     */
    public function withRotation(float|string $rotation): self
    {
        $obj = clone $this;
        $obj->rotation = $rotation;

        return $obj;
    }

    /**
     * Specifies the typography style of the text.
     * Supported values:
     *   - Single styles: `b` (bold), `i` (italic), `strikethrough`.
     *   - Combinations: Any combination separated by underscores, e.g., `b_i`, `b_i_strikethrough`.
     */
    public function withTypography(string $typography): self
    {
        $obj = clone $this;
        $obj->typography = $typography;

        return $obj;
    }

    /**
     * Specifies the maximum width (in pixels) of the overlaid text. The text wraps automatically, and arithmetic expressions (e.g., `bw_mul_0.2` or `bh_div_2`) are supported. Useful when used in conjunction with the `background`.
     * Learn about [Arithmetic expressions](https://imagekit.io/docs/arithmetic-expressions-in-transformations).
     */
    public function withWidth(float|string $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
