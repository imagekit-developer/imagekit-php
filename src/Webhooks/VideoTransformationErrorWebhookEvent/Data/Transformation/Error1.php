<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationErrorWebhookEvent\Data\Transformation\Error\Reason;

final class Error implements BaseModel
{
    use SdkModel;

    /** @var Reason::* $reason */
    #[Api(enum: Reason::class)]
    public string $reason;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withReason(...)
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
     * @param Reason::* $reason
     */
    public static function with(string $reason): self
    {
        $obj = new self;

        $obj->reason = $reason;

        return $obj;
    }

    /**
     * @param Reason::* $reason
     */
    public function withReason(string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason;

        return $obj;
    }
}
