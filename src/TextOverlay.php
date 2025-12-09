<?php

declare(strict_types=1);

namespace Imagekit;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\OverlayPosition\Focus;
use Imagekit\TextOverlay\Encoding;
use Imagekit\TextOverlayTransformation\Flip;
use Imagekit\TextOverlayTransformation\InnerAlignment;

/**
 * @phpstan-type TextOverlayShape = array{
 *   position?: OverlayPosition|null,
 *   timing?: OverlayTiming|null,
 *   text: string,
 *   type?: 'text',
 *   encoding?: value-of<Encoding>|null,
 *   transformation?: list<TextOverlayTransformation>|null,
 * }
 */
final class TextOverlay implements BaseModel
{
    /** @use SdkModel<TextOverlayShape> */
    use SdkModel;

    /** @var 'text' $type */
    #[Required]
    public string $type = 'text';

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
     * @param OverlayPosition|array{
     *   focus?: value-of<Focus>|null, x?: float|string|null, y?: float|string|null
     * } $position
     * @param OverlayTiming|array{
     *   duration?: float|string|null,
     *   end?: float|string|null,
     *   start?: float|string|null,
     * } $timing
     * @param Encoding|value-of<Encoding> $encoding
     * @param list<TextOverlayTransformation|array{
     *   alpha?: float|null,
     *   background?: string|null,
     *   flip?: value-of<Flip>|null,
     *   fontColor?: string|null,
     *   fontFamily?: string|null,
     *   fontSize?: float|string|null,
     *   innerAlignment?: value-of<InnerAlignment>|null,
     *   lineHeight?: float|string|null,
     *   padding?: float|string|null,
     *   radius?: float|'max'|null,
     *   rotation?: float|string|null,
     *   typography?: string|null,
     *   width?: float|string|null,
     * }> $transformation
     */
    public static function with(
        string $text,
        OverlayPosition|array|null $position = null,
        OverlayTiming|array|null $timing = null,
        Encoding|string|null $encoding = null,
        ?array $transformation = null,
    ): self {
        $self = new self;

        $self['text'] = $text;

        null !== $position && $self['position'] = $position;
        null !== $timing && $self['timing'] = $timing;
        null !== $encoding && $self['encoding'] = $encoding;
        null !== $transformation && $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * @param OverlayPosition|array{
     *   focus?: value-of<Focus>|null, x?: float|string|null, y?: float|string|null
     * } $position
     */
    public function withPosition(OverlayPosition|array $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

        return $self;
    }

    /**
     * @param OverlayTiming|array{
     *   duration?: float|string|null,
     *   end?: float|string|null,
     *   start?: float|string|null,
     * } $timing
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
     * Text can be included in the layer as either `i-{input}` (plain text) or `ie-{base64_encoded_input}` (base64).
     * By default, the SDK selects the appropriate format based on the input text.
     * To always use base64 (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
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
     * @param list<TextOverlayTransformation|array{
     *   alpha?: float|null,
     *   background?: string|null,
     *   flip?: value-of<Flip>|null,
     *   fontColor?: string|null,
     *   fontFamily?: string|null,
     *   fontSize?: float|string|null,
     *   innerAlignment?: value-of<InnerAlignment>|null,
     *   lineHeight?: float|string|null,
     *   padding?: float|string|null,
     *   radius?: float|'max'|null,
     *   rotation?: float|string|null,
     *   typography?: string|null,
     *   width?: float|string|null,
     * }> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
