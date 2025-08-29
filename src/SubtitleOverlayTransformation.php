<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SubtitleOverlayTransformation\Typography;

/**
 * @phpstan-type subtitle_overlay_transformation = array{
 *   background?: string|null,
 *   color?: string|null,
 *   fontFamily?: string|null,
 *   fontOutline?: string|null,
 *   fontShadow?: string|null,
 *   fontSize?: float|string|null,
 *   typography?: Typography::*|null,
 * }
 */
final class SubtitleOverlayTransformation implements BaseModel
{
    /** @use SdkModel<subtitle_overlay_transformation> */
    use SdkModel;

    /**
     * Background color for subtitles.
     */
    #[Api(optional: true)]
    public ?string $background;

    /**
     * Text color for subtitles.
     */
    #[Api(optional: true)]
    public ?string $color;

    /**
     * Font family for subtitles.
     */
    #[Api(optional: true)]
    public ?string $fontFamily;

    /**
     * Font outline for subtitles.
     */
    #[Api(optional: true)]
    public ?string $fontOutline;

    /**
     * Font shadow for subtitles.
     */
    #[Api(optional: true)]
    public ?string $fontShadow;

    /**
     * Font size for subtitles.
     */
    #[Api(optional: true)]
    public float|string|null $fontSize;

    /**
     * Typography style for subtitles.
     *
     * @var Typography::*|null $typography
     */
    #[Api(enum: Typography::class, optional: true)]
    public ?string $typography;

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
     * @param Typography::* $typography
     */
    public static function with(
        ?string $background = null,
        ?string $color = null,
        ?string $fontFamily = null,
        ?string $fontOutline = null,
        ?string $fontShadow = null,
        float|string|null $fontSize = null,
        ?string $typography = null,
    ): self {
        $obj = new self;

        null !== $background && $obj->background = $background;
        null !== $color && $obj->color = $color;
        null !== $fontFamily && $obj->fontFamily = $fontFamily;
        null !== $fontOutline && $obj->fontOutline = $fontOutline;
        null !== $fontShadow && $obj->fontShadow = $fontShadow;
        null !== $fontSize && $obj->fontSize = $fontSize;
        null !== $typography && $obj->typography = $typography;

        return $obj;
    }

    /**
     * Background color for subtitles.
     */
    public function withBackground(string $background): self
    {
        $obj = clone $this;
        $obj->background = $background;

        return $obj;
    }

    /**
     * Text color for subtitles.
     */
    public function withColor(string $color): self
    {
        $obj = clone $this;
        $obj->color = $color;

        return $obj;
    }

    /**
     * Font family for subtitles.
     */
    public function withFontFamily(string $fontFamily): self
    {
        $obj = clone $this;
        $obj->fontFamily = $fontFamily;

        return $obj;
    }

    /**
     * Font outline for subtitles.
     */
    public function withFontOutline(string $fontOutline): self
    {
        $obj = clone $this;
        $obj->fontOutline = $fontOutline;

        return $obj;
    }

    /**
     * Font shadow for subtitles.
     */
    public function withFontShadow(string $fontShadow): self
    {
        $obj = clone $this;
        $obj->fontShadow = $fontShadow;

        return $obj;
    }

    /**
     * Font size for subtitles.
     */
    public function withFontSize(float|string $fontSize): self
    {
        $obj = clone $this;
        $obj->fontSize = $fontSize;

        return $obj;
    }

    /**
     * Typography style for subtitles.
     *
     * @param Typography::* $typography
     */
    public function withTypography(string $typography): self
    {
        $obj = clone $this;
        $obj->typography = $typography;

        return $obj;
    }
}
