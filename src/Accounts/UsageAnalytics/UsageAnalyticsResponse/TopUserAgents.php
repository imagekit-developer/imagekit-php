<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents\ByBandwidth;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents\ByRequest;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Top user agents by traffic.
 *
 * @phpstan-import-type ByBandwidthShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents\ByBandwidth
 * @phpstan-import-type ByRequestShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents\ByRequest
 *
 * @phpstan-type TopUserAgentsShape = array{
 *   byBandwidth: list<ByBandwidth|ByBandwidthShape>,
 *   byRequests: list<ByRequest|ByRequestShape>,
 * }
 */
final class TopUserAgents implements BaseModel
{
    /** @use SdkModel<TopUserAgentsShape> */
    use SdkModel;

    /**
     * Top user agents sorted by bandwidth utilized.
     *
     * @var list<ByBandwidth> $byBandwidth
     */
    #[Required(list: ByBandwidth::class)]
    public array $byBandwidth;

    /**
     * Top user agents sorted by request count.
     *
     * @var list<ByRequest> $byRequests
     */
    #[Required(list: ByRequest::class)]
    public array $byRequests;

    /**
     * `new TopUserAgents()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopUserAgents::with(byBandwidth: ..., byRequests: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopUserAgents)->withByBandwidth(...)->withByRequests(...)
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
     * @param list<ByBandwidth|ByBandwidthShape> $byBandwidth
     * @param list<ByRequest|ByRequestShape> $byRequests
     */
    public static function with(array $byBandwidth, array $byRequests): self
    {
        $self = new self;

        $self['byBandwidth'] = $byBandwidth;
        $self['byRequests'] = $byRequests;

        return $self;
    }

    /**
     * Top user agents sorted by bandwidth utilized.
     *
     * @param list<ByBandwidth|ByBandwidthShape> $byBandwidth
     */
    public function withByBandwidth(array $byBandwidth): self
    {
        $self = clone $this;
        $self['byBandwidth'] = $byBandwidth;

        return $self;
    }

    /**
     * Top user agents sorted by request count.
     *
     * @param list<ByRequest|ByRequestShape> $byRequests
     */
    public function withByRequests(array $byRequests): self
    {
        $self = clone $this;
        $self['byRequests'] = $byRequests;

        return $self;
    }
}
