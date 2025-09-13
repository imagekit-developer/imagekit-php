<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output;
use ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Type;

/**
 * @phpstan-type transformation_alias = array{
 *   type: value-of<Type>, options?: Options, output?: Output
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<transformation_alias> */
    use SdkModel;

    /**
     * Type of video transformation:
     * - `video-transformation`: Standard video processing (resize, format conversion, etc.)
     * - `gif-to-video`: Convert animated GIF to video format
     * - `video-thumbnail`: Generate thumbnail image from video
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Configuration options for video transformations.
     */
    #[Api(optional: true)]
    public ?Options $options;

    /**
     * Information about the transformed output video.
     */
    #[Api(optional: true)]
    public ?Output $output;

    /**
     * `new Transformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transformation::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transformation)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        ?Options $options = null,
        ?Output $output = null
    ): self {
        $obj = new self;

        $obj->type = $type instanceof Type ? $type->value : $type;

        null !== $options && $obj->options = $options;
        null !== $output && $obj->output = $output;

        return $obj;
    }

    /**
     * Type of video transformation:
     * - `video-transformation`: Standard video processing (resize, format conversion, etc.)
     * - `gif-to-video`: Convert animated GIF to video format
     * - `video-thumbnail`: Generate thumbnail image from video
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    /**
     * Configuration options for video transformations.
     */
    public function withOptions(Options $options): self
    {
        $obj = clone $this;
        $obj->options = $options;

        return $obj;
    }

    /**
     * Information about the transformed output video.
     */
    public function withOutput(Output $output): self
    {
        $obj = clone $this;
        $obj->output = $output;

        return $obj;
    }
}
