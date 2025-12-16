<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformErrorEvent\Data;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-import-type ErrorShape from \Imagekit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error
 *
 * @phpstan-type TransformationShape = array{error: Error|ErrorShape}
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    #[Required]
    public Error $error;

    /**
     * `new Transformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transformation::with(error: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transformation)->withError(...)
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
     * @param ErrorShape $error
     */
    public static function with(Error|array $error): self
    {
        $self = new self;

        $self['error'] = $error;

        return $self;
    }

    /**
     * @param ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
