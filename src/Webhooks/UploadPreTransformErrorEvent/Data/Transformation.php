<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformErrorEvent\Data;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-import-type ErrorShape from \ImageKit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error
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
     * @param Error|ErrorShape $error
     */
    public static function with(Error|array $error): self
    {
        $self = new self;

        $self['error'] = $error;

        return $self;
    }

    /**
     * @param Error|ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
