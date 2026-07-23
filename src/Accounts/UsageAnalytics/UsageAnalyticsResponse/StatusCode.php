<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type StatusCodeShape = array{name: string, requestCount: float}
 */
final class StatusCode implements BaseModel
{
    /** @use SdkModel<StatusCodeShape> */
    use SdkModel;

    /**
     * HTTP status code.
     */
    #[Required]
    public string $name;

    /**
     * Number of requests that received this status code.
     */
    #[Required]
    public float $requestCount;

    /**
     * `new StatusCode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StatusCode::with(name: ..., requestCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StatusCode)->withName(...)->withRequestCount(...)
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
     * HTTP status code.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of requests that received this status code.
     */
    public function withRequestCount(float $requestCount): self
    {
        $self = clone $this;
        $self['requestCount'] = $requestCount;

        return $self;
    }
}
