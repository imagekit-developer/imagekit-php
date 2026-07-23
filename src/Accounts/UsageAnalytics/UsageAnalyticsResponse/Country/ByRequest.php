<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Country;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ByRequestShape = array{
 *   bandwidthBytes: float, requestCount: float, code: string, name: string
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
     * ISO country code.
     */
    #[Required]
    public string $code;

    /**
     * Country name.
     */
    #[Required]
    public string $name;

    /**
     * `new ByRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ByRequest::with(bandwidthBytes: ..., requestCount: ..., code: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ByRequest)
     *   ->withBandwidthBytes(...)
     *   ->withRequestCount(...)
     *   ->withCode(...)
     *   ->withName(...)
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
        string $code,
        string $name
    ): self {
        $self = new self;

        $self['bandwidthBytes'] = $bandwidthBytes;
        $self['requestCount'] = $requestCount;
        $self['code'] = $code;
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
     * ISO country code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Country name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
