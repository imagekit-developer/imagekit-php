<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationErrorEvent\Data;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Options;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Type;

/**
 * @phpstan-import-type ErrorShape from \Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error
 * @phpstan-import-type OptionsShape from \Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Options
 *
 * @phpstan-type TransformationShape = array{
 *   type: Type|value-of<Type>,
 *   error?: null|Error|ErrorShape,
 *   options?: null|Options|OptionsShape,
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
     * Details about the transformation error.
     */
    #[Optional]
    public ?Error $error;

    /**
     * Configuration options for video transformations.
     */
    #[Optional]
    public ?Options $options;

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
     * @param ErrorShape $error
     * @param OptionsShape $options
     */
    public static function with(
        Type|string $type,
        Error|array|null $error = null,
        Options|array|null $options = null
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $error && $self['error'] = $error;
        null !== $options && $self['options'] = $options;

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
     * Details about the transformation error.
     *
     * @param ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Configuration options for video transformations.
     *
     * @param OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
