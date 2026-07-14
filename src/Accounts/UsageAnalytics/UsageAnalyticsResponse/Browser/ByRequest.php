<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Browser;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByRequestShape = array{
 *   bandwidthBytes: float, requestCount: float, name: string
 * }
 */
final class ByRequest implements BaseModel
{
    /** @use SdkModel<ByRequestShape> */
    use SdkModel;

    /**
     * Total bandwidth used in bytes.
     */
    #[Required]
    public float $bandwidthBytes;

    /**
     * Number of requests.
     */
    #[Required]
    public float $requestCount;

    /**
     * Browser name (e.g. `Chrome`).
     */
    #[Required]
    public string $name;

    /**
     * `new ByRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ByRequest::with(bandwidthBytes: ..., requestCount: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ByRequest)->withBandwidthBytes(...)->withRequestCount(...)->withName(...)
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
    public static function with(
        float $bandwidthBytes,
        float $requestCount,
        string $name
    ): self {
        $self = new self;

        $self['bandwidthBytes'] = $bandwidthBytes;
        $self['requestCount'] = $requestCount;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Total bandwidth used in bytes.
     */
    public function withBandwidthBytes(float $bandwidthBytes): self
    {
        $self = clone $this;
        $self['bandwidthBytes'] = $bandwidthBytes;

        return $self;
    }

    /**
     * Number of requests.
     */
    public function withRequestCount(float $requestCount): self
    {
        $self = clone $this;
        $self['requestCount'] = $requestCount;

        return $self;
    }

    /**
     * Browser name (e.g. `Chrome`).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
