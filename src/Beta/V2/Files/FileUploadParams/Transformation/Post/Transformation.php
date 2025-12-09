<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type TransformationShape = array{
 *   type?: 'transformation', value: string
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
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
     * `new Transformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transformation::with(value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transformation)->withValue(...)
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
