<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPostTransformErrorEvent\Request;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation\Protocol;
use Imagekit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation\Type;

/**
 * @phpstan-type TransformationShape = array{
 *   type: Type|value-of<Type>,
 *   protocol?: null|Protocol|value-of<Protocol>,
 *   value?: string|null,
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
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @var value-of<Protocol>|null $protocol
     */
    #[Optional(enum: Protocol::class)]
    public ?string $protocol;

    /**
     * Value for the requested transformation type.
     */
    #[Optional]
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
     * @param Protocol|value-of<Protocol>|null $protocol
     */
    public static function with(
        Type|string $type,
        Protocol|string|null $protocol = null,
        ?string $value = null
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $protocol && $self['protocol'] = $protocol;
        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * Type of the requested post-transformation.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Only applicable if transformation type is 'abs'. Streaming protocol used.
     *
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * Value for the requested transformation type.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
