<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams\Transformation\Post;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type TransformationShape = array{type: 'transformation', value: string}
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
    #[Api]
    public string $type = 'transformation';

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    #[Api]
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
        $obj = new self;

        $obj['value'] = $value;

        return $obj;
    }

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj['value'] = $value;

        return $obj;
    }
}
