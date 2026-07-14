<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type RequestBandwidthEntryShape = array{
 *   bandwidthBytes: float, requestCount: float
 * }
 */
final class RequestBandwidthEntry implements BaseModel
{
    /** @use SdkModel<RequestBandwidthEntryShape> */
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
     * `new RequestBandwidthEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RequestBandwidthEntry::with(bandwidthBytes: ..., requestCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RequestBandwidthEntry)->withBandwidthBytes(...)->withRequestCount(...)
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
        float $requestCount
    ): self {
        $self = new self;

        $self['bandwidthBytes'] = $bandwidthBytes;
        $self['requestCount'] = $requestCount;

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
}
