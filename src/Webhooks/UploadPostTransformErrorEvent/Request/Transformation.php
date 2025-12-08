<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformErrorEvent\Request;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation\Protocol;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation\Type;

/**
 * @phpstan-type TransformationShape = array{
 *   type: value-of<Type>, protocol?: value-of<Protocol>|null, value?: string|null
 * }
 */
final class Transformation implements BaseModel
{
    /** @use SdkModel<TransformationShape> */
    use SdkModel;

    /**
     * Type of the requested post-transformation.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @var value-of<Protocol>|null $protocol
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
     * @param Type|value-of<Type> $type
     * @param Protocol|value-of<Protocol> $protocol
     */
    public static function with(
        Type|string $type,
        Protocol|string|null $protocol = null,
        ?string $value = null
    ): self {
        $obj = new self;

        $obj['type'] = $type;

        null !== $protocol && $obj['protocol'] = $protocol;
        null !== $value && $obj['value'] = $value;

        return $obj;
    }

    /**
     * Type of the requested post-transformation.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $obj = clone $this;
        $obj['protocol'] = $protocol;

        return $obj;
    }

    /**
     * Value for the requested transformation type.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj['value'] = $value;

        return $obj;
    }
}
