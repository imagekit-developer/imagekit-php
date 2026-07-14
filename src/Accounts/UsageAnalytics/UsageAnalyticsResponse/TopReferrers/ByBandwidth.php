<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopReferrers;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByBandwidthShape = array{
 *   bandwidthBytes: float, requestCount: float, name: string
 * }
 */
final class ByBandwidth implements BaseModel
{
    /** @use SdkModel<ByBandwidthShape> */
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
     * Referrer URL.
     */
    #[Required]
    public string $name;

    /**
     * `new ByBandwidth()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ByBandwidth::with(bandwidthBytes: ..., requestCount: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ByBandwidth)->withBandwidthBytes(...)->withRequestCount(...)->withName(...)
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
     * Referrer URL.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
