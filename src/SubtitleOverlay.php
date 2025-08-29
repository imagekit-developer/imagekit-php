<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\SubtitleOverlay\Encoding;
use ImageKit\SubtitleOverlay\Type;

/**
 * @phpstan-type subtitle_overlay = array{
 *   input: string,
 *   type: Type::*,
 *   encoding?: Encoding::*|null,
 *   transformation?: list<SubtitleOverlayTransformation>|null,
 * }
 */
final class SubtitleOverlay implements BaseModel
{
    /** @use SdkModel<subtitle_overlay> */
    use SdkModel;

    /**
     * Specifies the relative path to the subtitle file used as an overlay.
     */
    #[Api]
    public string $input;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
     * By default, the SDK determines the appropriate format automatically.
     * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * @var Encoding::*|null $encoding
     */
    #[Api(enum: Encoding::class, optional: true)]
    public ?string $encoding;

    /**
     * Control styling of the subtitle.
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
     * SubtitleOverlay::with(input: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubtitleOverlay)->withInput(...)->withType(...)
     * ```
     */
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
     * @param Type::* $type
     * @param Encoding::* $encoding
     * @param list<SubtitleOverlayTransformation> $transformation
     */
    public static function with(
        string $input,
        string $type,
        ?string $encoding = null,
        ?array $transformation = null,
    ): self {
        $obj = new self;

        $obj->input = $input;
        $obj->type = $type;

        null !== $encoding && $obj->encoding = $encoding;
        null !== $transformation && $obj->transformation = $transformation;

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
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
     * By default, the SDK determines the appropriate format automatically.
     * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
     * To always use plain text (`i-{input}`), set it to `plain`.
     *
     * @param Encoding::* $encoding
     */
    public function withEncoding(string $encoding): self
    {
        $obj = clone $this;
        $obj->encoding = $encoding;

        return $obj;
    }

    /**
     * Control styling of the subtitle.
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
