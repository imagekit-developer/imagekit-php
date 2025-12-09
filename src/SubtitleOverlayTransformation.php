<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\SubtitleOverlayTransformation\Typography;

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
    #[Optional]
    public ?string $background;

    /**
     * Sets the font color of the subtitle text using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Optional]
    public ?string $color;

    /**
     * Font family for subtitles. Refer to the [supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list).
     */
    #[Optional]
    public ?string $fontFamily;

    /**
     * Sets the font outline of the subtitle text.
     * Requires the outline width (an integer) and the outline color (as an RGB color code, RGBA color code, or standard web color name) separated by an underscore.
     * Example: `fol-2_blue` (outline width of 2px and outline color blue), `fol-2_A1CCDD` (outline width of 2px and outline color `#A1CCDD`) and `fol-2_A1CCDD50` (outline width of 2px and outline color `#A1CCDD` at 50% opacity).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Optional]
    public ?string $fontOutline;

    /**
     * Sets the font shadow for the subtitle text.
     * Requires the shadow color (as an RGB color code, RGBA color code, or standard web color name) and shadow indent (an integer) separated by an underscore.
     * Example: `fsh-blue_2` (shadow color blue, indent of 2px), `fsh-A1CCDD_3` (shadow color `#A1CCDD`, indent of 3px), `fsh-A1CCDD50_3` (shadow color `#A1CCDD` at 50% opacity, indent of 3px).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Optional]
    public ?string $fontShadow;

    /**
     * Sets the font size of subtitle text.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    #[Optional]
    public ?float $fontSize;

    /**
     * Sets the typography style of the subtitle text. Supports values are `b` for bold, `i` for italics, and `b_i` for bold with italics.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     *
     * @var value-of<Typography>|null $typography
     */
    #[Optional(enum: Typography::class)]
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
        $self = new self;

        null !== $background && $self['background'] = $background;
        null !== $color && $self['color'] = $color;
        null !== $fontFamily && $self['fontFamily'] = $fontFamily;
        null !== $fontOutline && $self['fontOutline'] = $fontOutline;
        null !== $fontShadow && $self['fontShadow'] = $fontShadow;
        null !== $fontSize && $self['fontSize'] = $fontSize;
        null !== $typography && $self['typography'] = $typography;

        return $self;
    }

    /**
     * Specifies the subtitle background color using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withBackground(string $background): self
    {
        $self = clone $this;
        $self['background'] = $background;

        return $self;
    }

    /**
     * Sets the font color of the subtitle text using a standard color name, an RGB color code (e.g., FF0000), or an RGBA color code (e.g., FFAABB50).
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withColor(string $color): self
    {
        $self = clone $this;
        $self['color'] = $color;

        return $self;
    }

    /**
     * Font family for subtitles. Refer to the [supported fonts](https://imagekit.io/docs/add-overlays-on-images#supported-text-font-list).
     */
    public function withFontFamily(string $fontFamily): self
    {
        $self = clone $this;
        $self['fontFamily'] = $fontFamily;

        return $self;
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
        $self = clone $this;
        $self['fontOutline'] = $fontOutline;

        return $self;
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
        $self = clone $this;
        $self['fontShadow'] = $fontShadow;

        return $self;
    }

    /**
     * Sets the font size of subtitle text.
     *
     * [Subtitle styling options](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer)
     */
    public function withFontSize(float $fontSize): self
    {
        $self = clone $this;
        $self['fontSize'] = $fontSize;

        return $self;
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
        $self = clone $this;
        $self['typography'] = $typography;

        return $self;
    }
}
