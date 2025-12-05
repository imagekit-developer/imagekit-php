<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformErrorEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPostTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-type TransformationShape = array{error: Error}
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    #[Api]
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
     * @param Error|array{reason: string} $error
     */
    public static function with(Error|array $error): self
    {
        $obj = new self;

        $obj['error'] = $error;

        return $obj;
    }

    /**
     * @param Error|array{reason: string} $error
     */
    public function withError(Error|array $error): self
    {
        $obj = clone $this;
        $obj['error'] = $error;

        return $obj;
    }
}
