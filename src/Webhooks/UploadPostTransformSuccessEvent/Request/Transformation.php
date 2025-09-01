<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformSuccessEvent\Request;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent\Request\Transformation\Protocol;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent\Request\Transformation\Type;

/**
 * @phpstan-type transformation_alias = array{
 *   type: Type::*, protocol?: Protocol::*|null, value?: string|null
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<transformation_alias> */
    use SdkModel;

    /**
     * Type of the requested post-transformation.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @var Protocol::*|null $protocol
     */
    #[Api(enum: Protocol::class, optional: true)]
    public ?string $protocol;

    /**
     * Value for the requested transformation type.
     */
    #[Api(optional: true)]
    public ?string $value;

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
     * @param Type::* $type
     * @param Protocol::* $protocol
     */
    public static function with(
        string $type,
        ?string $protocol = null,
        ?string $value = null
    ): self {
        $obj = new self;

        $obj->type = $type;

        null !== $protocol && $obj->protocol = $protocol;
        null !== $value && $obj->value = $value;

        return $obj;
    }

    /**
     * Type of the requested post-transformation.
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
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @param Protocol::* $protocol
     */
    public function withProtocol(string $protocol): self
    {
        $obj = clone $this;
        $obj->protocol = $protocol;

        return $obj;
    }

    /**
     * Value for the requested transformation type.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
