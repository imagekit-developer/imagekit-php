<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets\ByBandwidth;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets\ByRequest;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Top non-image, non-video assets by traffic.
 *
 * @phpstan-import-type ByBandwidthShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets\ByBandwidth
 * @phpstan-import-type ByRequestShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets\ByRequest
 *
 * @phpstan-type TopOtherAssetsShape = array{
 *   byBandwidth: list<ByBandwidth|ByBandwidthShape>,
 *   byRequests: list<ByRequest|ByRequestShape>,
 * }
 */
final class TopOtherAssets implements BaseModel
{
    /** @use SdkModel<TopOtherAssetsShape> */
    use SdkModel;

    /**
     * Top non-image, non-video assets sorted by bandwidth utilized.
     *
     * @var list<ByBandwidth> $byBandwidth
     */
    #[Required(list: ByBandwidth::class)]
    public array $byBandwidth;

    /**
     * Top non-image, non-video assets sorted by request count.
     *
     * @var list<ByRequest> $byRequests
     */
    #[Required(list: ByRequest::class)]
    public array $byRequests;

    /**
     * `new TopOtherAssets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopOtherAssets::with(byBandwidth: ..., byRequests: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopOtherAssets)->withByBandwidth(...)->withByRequests(...)
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
     * Top non-image, non-video assets sorted by bandwidth utilized.
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
     * Top non-image, non-video assets sorted by request count.
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
