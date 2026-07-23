<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type Top404AssetShape = array{name: string, requestCount: float}
 */
final class Top404Asset implements BaseModel
{
    /** @use SdkModel<Top404AssetShape> */
    use SdkModel;

    /**
     * URL that returned a 404 response.
     */
    #[Required]
    public string $name;

    /**
     * Number of requests to this URL that returned a 404 response.
     */
    #[Required]
    public float $requestCount;

    /**
     * `new Top404Asset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Top404Asset::with(name: ..., requestCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Top404Asset)->withName(...)->withRequestCount(...)
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
     * URL that returned a 404 response.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of requests to this URL that returned a 404 response.
     */
    public function withRequestCount(float $requestCount): self
    {
        $self = clone $this;
        $self['requestCount'] = $requestCount;

        return $self;
    }
}
