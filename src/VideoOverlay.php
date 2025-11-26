<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\VideoOverlay\Encoding;

/**
 * @phpstan-type VideoOverlayShape = array{
 *   position?: OverlayPosition|null,
 *   timing?: OverlayTiming|null,
 *   input: string,
 *   type: 'video',
 *   encoding?: value-of<Encoding>|null,
 *   transformation?: list<Transformation>|null,
 * }
 */
final class VideoOverlay implements BaseModel
{
    /** @use SdkModel<VideoOverlayShape> */
    use SdkModel;

    /** @var 'video' $type */
    #[Api]
    public string $type = 'video';

    #[Api(optional: true)]
    public ?OverlayPosition $position;

    #[Api(optional: true)]
    public ?OverlayTiming $timing;

    /**
     * Specifies the relative path to the video used as an overlay.
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
     * Array of transformation to be applied to the overlay video. Except `streamingResolutions`, all other video transformations are supported.
     * See [Video transformations](https://imagekit.io/docs/video-transformation).
     *
     * @var list<Transformation>|null $transformation
     */
    #[Api(list: Transformation::class, optional: true)]
    public ?array $transformation;

    /**
     * `new VideoOverlay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VideoOverlay::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VideoOverlay)->withInput(...)
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
     * @param list<Transformation> $transformation
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
     * Specifies the relative path to the video used as an overlay.
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
     * Array of transformation to be applied to the overlay video. Except `streamingResolutions`, all other video transformations are supported.
     * See [Video transformations](https://imagekit.io/docs/video-transformation).
     *
     * @param list<Transformation> $transformation
     */
    public function withTransformation(array $transformation): self
    {
        $obj = clone $this;
        $obj->transformation = $transformation;

        return $obj;
    }
}
