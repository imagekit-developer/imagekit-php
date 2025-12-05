<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SubtitleOverlayTransformation\Typography;

/**
 * Subtitle styling options. [Learn more](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer) from the docs.
 *
 * @phpstan-type SubtitleOverlayTransformationShape = array{
 *   background?: string|null,
 *   color?: string|null,
 *   fontFamily?: string|null,
 *   fontOutline?: string|null,
 *   fontShadow?: string|null,
 *   fontSize?: float|null,
 *   typography?: value-of<Typography>|null,
 * }
 */
final class SubtitleOverlayTransformation implements BaseModel
{
    /** @use SdkModel<SubtitleOverlayTransformationShape> */
    use SdkModel;

    /**
     * Specifies the subtitle background color using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Sets the font color of the subtitle text using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Api(optional: true)]
    public ?string $color;

    /**
     * Font family for subtitles. Refer to the [supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list).
     */
    #[Api(optional: true)]
    public ?string $fontFamily;

    /**
     * Sets the font outline of the subtitle text.
     * Requires the outline width (an integer) and the outline color (as an RGB color code, RGBA color code, or standard web color name) separated by an underscore.
     * Example: `fol-2_blue` (outline width of 2px and outline color blue), `fol-2_A1CCDD` (outline width of 2px and outline color `#A1CCDD`) and `fol-2_A1CCDD50` (outline width of 2px and outline color `#A1CCDD` at 50% opacity).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Api(optional: true)]
    public ?string $fontOutline;

    /**
     * Sets the font shadow for the subtitle text.
     * Requires the shadow color (as an RGB color code, RGBA color code, or standard web color name) and shadow indent (an integer) separated by an underscore.
     * Example: `fsh-blue_2` (shadow color blue, indent of 2px), `fsh-A1CCDD_3` (shadow color `#A1CCDD`, indent of 3px), `fsh-A1CCDD50_3` (shadow color `#A1CCDD` at 50% opacity, indent of 3px).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Api(optional: true)]
    public ?string $fontShadow;

    /**
     * Sets the font size of subtitle text.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Api(optional: true)]
    public ?float $fontSize;

    /**
     * Sets the typography style of the subtitle text. Supports values are `b` for bold, `i` for italics, and `b_i` for bold with italics.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     *
     * @var value-of<Typography>|null $typography
     */
    #[Api(enum: Typography::class, optional: true)]
    public ?string $typography;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Typography|value-of<Typography> $typography
     */
    public static function with(
        ?string $background = null,
        ?string $color = null,
        ?string $fontFamily = null,
        ?string $fontOutline = null,
        ?string $fontShadow = null,
        ?float $fontSize = null,
        Typography|string|null $typography = null,
    ): self {
        $obj = new self;

        null !== $background && $obj['background'] = $background;
        null !== $color && $obj['color'] = $color;
        null !== $fontFamily && $obj['fontFamily'] = $fontFamily;
        null !== $fontOutline && $obj['fontOutline'] = $fontOutline;
        null !== $fontShadow && $obj['fontShadow'] = $fontShadow;
        null !== $fontSize && $obj['fontSize'] = $fontSize;
        null !== $typography && $obj['typography'] = $typography;

        return $obj;
    }

    /**
     * Specifies the subtitle background color using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withBackground(string $background): self
    {
        $obj = clone $this;
        $obj['background'] = $background;

        return $obj;
    }

    /**
     * Sets the font color of the subtitle text using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withColor(string $color): self
    {
        $obj = clone $this;
        $obj['color'] = $color;

        return $obj;
    }

    /**
     * Font family for subtitles. Refer to the [supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $obj = clone $this;
        $obj['fontFamily'] = $fontFamily;

        return $obj;
    }

    /**
     * Sets the font outline of the subtitle text.
     * Requires the outline width (an integer) and the outline color (as an RGB color code, RGBA color code, or standard web color name) separated by an underscore.
     * Example: `fol-2_blue` (outline width of 2px and outline color blue), `fol-2_A1CCDD` (outline width of 2px and outline color `#A1CCDD`) and `fol-2_A1CCDD50` (outline width of 2px and outline color `#A1CCDD` at 50% opacity).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withFontOutline(string $fontOutline): self
    {
        $obj = clone $this;
        $obj['fontOutline'] = $fontOutline;

        return $obj;
    }

    /**
     * Sets the font shadow for the subtitle text.
     * Requires the shadow color (as an RGB color code, RGBA color code, or standard web color name) and shadow indent (an integer) separated by an underscore.
     * Example: `fsh-blue_2` (shadow color blue, indent of 2px), `fsh-A1CCDD_3` (shadow color `#A1CCDD`, indent of 3px), `fsh-A1CCDD50_3` (shadow color `#A1CCDD` at 50% opacity, indent of 3px).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withFontShadow(string $fontShadow): self
    {
        $obj = clone $this;
        $obj['fontShadow'] = $fontShadow;

        return $obj;
    }

    /**
     * Sets the font size of subtitle text.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withFontSize(float $fontSize): self
    {
        $obj = clone $this;
        $obj['fontSize'] = $fontSize;

        return $obj;
    }

    /**
     * Sets the typography style of the subtitle text. Supports values are `b` for bold, `i` for italics, and `b_i` for bold with italics.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     *
     * @param Typography|value-of<Typography> $typography
     */
    public function withTypography(Typography|string $typography): self
    {
        $obj = clone $this;
        $obj['typography'] = $typography;

        return $obj;
    }
}
