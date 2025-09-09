<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error\Reason;

/**
 * Details about the transformation error.
 *
 * @phpstan-type error_alias = array{reason: value-of<Reason>}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<error_alias> */
    use SdkModel;

    /**
     * Specific reason for the transformation failure:
     * - `encoding_failed`: Error during video encoding process
     * - `download_failed`: Could not download source video
     * - `internal_server_error`: Unexpected server error
     *
     * @var value-of<Reason> $reason
     */
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(Reason|string $reason): self
    {
        $obj = new self;

        $obj->reason = $reason instanceof Reason ? $reason->value : $reason;

        return $obj;
    }

    /**
     * Specific reason for the transformation failure:
     * - `encoding_failed`: Error during video encoding process
     * - `download_failed`: Could not download source video
     * - `internal_server_error`: Unexpected server error
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $obj = clone $this;
        $obj->reason = $reason instanceof Reason ? $reason->value : $reason;

        return $obj;
    }
}
