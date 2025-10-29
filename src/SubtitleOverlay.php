<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SubtitleOverlay\Encoding;

/**
 * @phpstan-type SubtitleOverlayShape = array{
 *   position?: OverlayPosition,
 *   timing?: OverlayTiming,
 *   input: string,
 *   type: string,
 *   encoding?: value-of<Encoding>,
 *   transformation?: list<SubtitleOverlayTransformation>,
 * }
 */
final class SubtitleOverlay implements BaseModel
{
    /** @use SdkModel<SubtitleOverlayShape> */
    use SdkModel;

    #[Api]
    public string $type = 'subtitle';

    #[Api(optional: true)]
    public ?OverlayPosition $position;

    #[Api(optional: true)]
    public ?OverlayTiming $timing;

    /**
     * Specifies the relative path to the subtitle file used as an overlay.
     */
    #[Api]
    public string $input;

    /**
     * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
     * By default, the SDK determines the appropriate format automatically.
     * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * @var value-of<Encoding>|null $encoding
     */
    #[Api(enum: Encoding::class, optional: true)]
    public ?string $encoding;

    /**
     * Control styling of the subtitle. See [Styling subtitles](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer).
     *
     * @var list<SubtitleOverlayTransformation>|null $transformation
     */
    #[Api(list: SubtitleOverlayTransformation::class, optional: true)]
    public ?array $transformation;

    /**
     * `new SubtitleOverlay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubtitleOverlay::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitleOverlay)->withInput(...)
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
     * @param Encoding|value-of<Encoding> $encoding
     * @param list<SubtitleOverlayTransformation> $transformation
     */
    public static function with(
        string $input,
        ?OverlayPosition $position = null,
        ?OverlayTiming $timing = null,
        Encoding|string|null $encoding = null,
        ?array $transformation = null,
    ): self {
        $obj = new self;

        $obj->input = $input;

        null !== $position && $obj->position = $position;
        null !== $timing && $obj->timing = $timing;
        null !== $encoding && $obj['encoding'] = $encoding;
        null !== $transformation && $obj->transformation = $transformation;

        return $obj;
    }

    public function withPosition(OverlayPosition $position): self
    {
        $obj = clone $this;
        $obj->position = $position;

        return $obj;
    }

    public function withTiming(OverlayTiming $timing): self
    {
        $obj = clone $this;
        $obj->timing = $timing;

        return $obj;
    }

    /**
     * Specifies the relative path to the subtitle file used as an overlay.
     */
    public function withInput(string $input): self
    {
        $obj = clone $this;
        $obj->input = $input;

        return $obj;
    }

    /**
     * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
     * By default, the SDK determines the appropriate format automatically.
     * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * @param Encoding|value-of<Encoding> $encoding
     */
    public function withEncoding(Encoding|string $encoding): self
    {
        $obj = clone $this;
        $obj['encoding'] = $encoding;

        return $obj;
    }

    /**
     * Control styling of the subtitle. See [Styling subtitles](https://imagekit.io/docs/add-overlays-on-videos#styling-controls-for-subtitles-layer).
     *
     * @param list<SubtitleOverlayTransformation> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }
}
