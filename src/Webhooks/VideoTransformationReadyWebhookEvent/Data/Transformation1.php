<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation\Options;
use ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation\Output;
use ImageKit\Webhooks\VideoTransformationReadyWebhookEvent\Data\Transformation\Type;

final class Transformation implements BaseModel
{
    use SdkModel;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(optional: true)]
    public ?Options $options;

    #[Api(optional: true)]
    public ?Output $output;

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
    public static function with(
        string $type,
        ?Options $options = null,
        ?Output $output = null
    ): self {
        $obj = new self;

        $obj->type = $type;

        null !== $options && $obj->options = $options;
        null !== $output && $obj->output = $output;

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

    public function withOutput(Output $output): self
    {
        $obj = clone $this;
        $obj->output = $output;

        return $obj;
    }
}
