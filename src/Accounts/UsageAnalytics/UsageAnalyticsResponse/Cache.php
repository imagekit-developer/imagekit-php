<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * CDN cache hit, miss and error counts for the date range.
 *
 * @phpstan-type CacheShape = array{
 *   errorCount: float, hitCount: float, missCount: float
 * }
 */
final class Cache implements BaseModel
{
    /** @use SdkModel<CacheShape> */
    use SdkModel;

    /**
     * Number of requests where the CDN encountered a cache error or exceeded capacity while serving the response.
     */
    #[Required]
    public float $errorCount;

    /**
     * Number of requests served from cache, including full hits and revalidated hits.
     */
    #[Required]
    public float $hitCount;

    /**
     * Number of requests that were not found in cache and had to be fetched from origin.
     */
    #[Required]
    public float $missCount;

    /**
     * `new Cache()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cache::with(errorCount: ..., hitCount: ..., missCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cache)->withErrorCount(...)->withHitCount(...)->withMissCount(...)
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
        float $errorCount,
        float $hitCount,
        float $missCount
    ): self {
        $self = new self;

        $self['errorCount'] = $errorCount;
        $self['hitCount'] = $hitCount;
        $self['missCount'] = $missCount;

        return $self;
    }

    /**
     * Number of requests where the CDN encountered a cache error or exceeded capacity while serving the response.
     */
    public function withErrorCount(float $errorCount): self
    {
        $self = clone $this;
        $self['errorCount'] = $errorCount;

        return $self;
    }

    /**
     * Number of requests served from cache, including full hits and revalidated hits.
     */
    public function withHitCount(float $hitCount): self
    {
        $self = clone $this;
        $self['hitCount'] = $hitCount;

        return $self;
    }

    /**
     * Number of requests that were not found in cache and had to be fetched from origin.
     */
    public function withMissCount(float $missCount): self
    {
        $self = clone $this;
        $self['missCount'] = $missCount;

        return $self;
    }
}
