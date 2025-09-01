<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformErrorEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPreTransformErrorEvent\Data\Transformation\Error;

/**
 * @phpstan-type transformation_alias = array{error: Error}
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<transformation_alias> */
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
     */
    public static function with(Error $error): self
    {
        $obj = new self;

        $obj->error = $error;

        return $obj;
    }

    public function withError(Error $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }
}
