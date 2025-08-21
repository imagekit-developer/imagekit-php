<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\SimplePostTransformation\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type simple_post_transformation_alias = array{
 *   type: Type::*, value: string
 * }
 */
final class SimplePostTransformation implements BaseModel
{
    use SdkModel;

    /**
     * Transformation type.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    #[Api]
    public string $value;

    /**
     * `new SimplePostTransformation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SimplePostTransformation::with(type: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SimplePostTransformation)->withType(...)->withValue(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(string $type, string $value): self
    {
        $obj = new self;

        $obj->type = $type;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Transformation type.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Transformation string (e.g. `w-200,h-200`).
     * Same syntax as ImageKit URL-based transformations.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
