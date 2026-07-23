<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExtensionShape = array{name: string, operationCount: float}
 */
final class Extension implements BaseModel
{
    /** @use SdkModel<ExtensionShape> */
    use SdkModel;

    /**
     * Extension identifier.
     */
    #[Required]
    public string $name;

    /**
     * Number of times this extension ran during the date range.
     */
    #[Required]
    public float $operationCount;

    /**
     * `new Extension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Extension::with(name: ..., operationCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Extension)->withName(...)->withOperationCount(...)
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
    public static function with(string $name, float $operationCount): self
    {
        $self = new self;

        $self['name'] = $name;
        $self['operationCount'] = $operationCount;

        return $self;
    }

    /**
     * Extension identifier.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of times this extension ran during the date range.
     */
    public function withOperationCount(float $operationCount): self
    {
        $self = clone $this;
        $self['operationCount'] = $operationCount;

        return $self;
    }
}
