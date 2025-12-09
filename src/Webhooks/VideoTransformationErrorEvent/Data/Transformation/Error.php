<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\Webhooks\VideoTransformationErrorEvent\Data\Transformation\Error\Reason;

/**
 * Details about the transformation error.
 *
 * @phpstan-type ErrorShape = array{reason: value-of<Reason>}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Specific reason for the transformation failure:
     * - `encoding_failed`: Error during video encoding process
     * - `download_failed`: Could not download source video
     * - `internal_server_error`: Unexpected server error
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
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
        $self = new self;

        $self['reason'] = $reason;

        return $self;
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
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
