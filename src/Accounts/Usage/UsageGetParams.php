<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Usage;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
 *
 * For an agency account, the returned usage is aggregated across the agency and all of its child accounts that are billed to it.
 *
 * The response is cached for 6 hours per account, date range and requested metrics.
 *
 * @see ImageKit\Services\Accounts\UsageService::get()
 *
 * @phpstan-type UsageGetParamsShape = array{endDate: string, startDate: string}
 */
final class UsageGetParams implements BaseModel
{
    /** @use SdkModel<UsageGetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Required]
    public string $endDate;

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Required]
    public string $startDate;

    /**
     * `new UsageGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageGetParams::with(endDate: ..., startDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageGetParams)->withEndDate(...)->withStartDate(...)
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
    public static function with(string $endDate, string $startDate): self
    {
        $self = new self;

        $self['endDate'] = $endDate;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
