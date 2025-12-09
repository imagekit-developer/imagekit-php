<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformErrorEvent;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation;
use Imagekit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-type DataShape = array{
 *   name: string, path: string, transformation: Transformation
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Name of the file.
     */
    #[Required]
    public string $name;

    /**
     * Path of the file.
     */
    #[Required]
    public string $path;

    #[Required]
    public Transformation $transformation;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(name: ..., path: ..., transformation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withName(...)->withPath(...)->withTransformation(...)
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
     * @param Transformation|array{error: Error} $transformation
     */
    public static function with(
        string $name,
        string $path,
        Transformation|array $transformation
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['path'] = $path;
        $self['transformation'] = $transformation;

        return $self;
    }

    /**
     * Name of the file.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Path of the file.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * @param Transformation|array{error: Error} $transformation
     */
    public function withTransformation(
        Transformation|array $transformation
    ): self {
        $self = clone $this;
        $self['transformation'] = $transformation;

        return $self;
    }
}
