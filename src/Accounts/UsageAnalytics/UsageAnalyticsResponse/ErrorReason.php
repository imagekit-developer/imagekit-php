<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ErrorReasonShape = array{name: string, requestCount: float}
 */
final class ErrorReason implements BaseModel
{
    /** @use SdkModel<ErrorReasonShape> */
    use SdkModel;

    /**
     * Description of the error reason.
     */
    #[Required]
    public string $name;

    /**
     * Number of requests that failed with this error reason.
     */
    #[Required]
    public float $requestCount;

    /**
     * `new ErrorReason()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ErrorReason::with(name: ..., requestCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ErrorReason)->withName(...)->withRequestCount(...)
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
    public static function with(string $name, float $requestCount): self
    {
        $self = new self;

        $self['name'] = $name;
        $self['requestCount'] = $requestCount;

        return $self;
    }

    /**
     * Description of the error reason.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of requests that failed with this error reason.
     */
    public function withRequestCount(float $requestCount): self
    {
        $self = clone $this;
        $self['requestCount'] = $requestCount;

        return $self;
    }
}
