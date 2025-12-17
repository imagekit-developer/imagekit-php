<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationReadyEvent\Data;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output;
use Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Type;

/**
 * @phpstan-import-type OptionsShape from \Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options
 * @phpstan-import-type OutputShape from \Imagekit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Output
 *
 * @phpstan-type TransformationShape = array{
 *   type: Type|value-of<Type>,
 *   options?: null|Options|OptionsShape,
 *   output?: null|Output|OutputShape,
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    /**
     * Type of video transformation:
     * - `video-transformation`: Standard video processing (resize, format conversion, etc.)
     * - `gif-to-video`: Convert animated GIF to video format
     * - `video-thumbnail`: Generate thumbnail image from video
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Configuration options for video transformations.
     */
    #[Optional]
    public ?Options $options;

    /**
     * Information about the transformed output video.
     */
    #[Optional]
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
     * @param Options|OptionsShape|null $options
     * @param Output|OutputShape|null $output
     */
    public static function with(
        Type|string $type,
        Options|array|null $options = null,
        Output|array|null $output = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $options && $self['options'] = $options;
        null !== $output && $self['output'] = $output;

        return $self;
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
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Configuration options for video transformations.
     *
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
     * Information about the transformed output video.
     *
     * @param Output|OutputShape $output
     */
    public function withOutput(Output|array $output): self
    {
        $self = clone $this;
        $self['output'] = $output;

        return $self;
    }
}
