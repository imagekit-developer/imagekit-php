<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options;
use ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Type;

/**
 * @phpstan-type transformation_alias = array{type: Type::*, options?: Options}
 */
final class Transformation implements BaseModel
{
    use SdkModel;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(optional: true)]
    public ?Options $options;

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
    public static function with(string $type, ?Options $options = null): self
    {
        $obj = new self;

        $obj->type = $type;

        null !== $options && $obj->options = $options;

        return $obj;
    }

    /**
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    public function withOptions(Options $options): self
    {
        $obj = clone $this;
        $obj->options = $options;

        return $obj;
    }
}
