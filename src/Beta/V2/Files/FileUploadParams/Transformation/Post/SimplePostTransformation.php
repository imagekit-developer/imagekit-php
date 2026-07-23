<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type SimplePostTransformationShape = array{
 *   type: 'transformation', value: string
 * }
 */
final class SimplePostTransformation implements BaseModel
{
    /** @use SdkModel<SimplePostTransformationShape> */
    use SdkModel;

    /**
     * Transformation type.
     *
     * @var 'transformation' $type
     */
    #[Required]
    public string $type = 'transformation';

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    #[Required]
    public string $value;

    /**
     * `new SimplePostTransformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SimplePostTransformation::with(value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SimplePostTransformation)->withValue(...)
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
     */
    public static function with(string $value): self
    {
        $self = new self;

        $self['value'] = $value;

        return $self;
    }

    /**
     * Transformation type.
     *
     * @param 'transformation' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
