<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 *
 * Get the account analytics data between two dates. The response covers the period from the start date to the end date, both dates inclusive. Both dates are interpreted as UTC calendar days.
 *
 * The returned data is scoped to the requesting account only. Unlike `/v1/accounts/usage`, an agency account's analytics are not aggregated across its child accounts.
 *
 * The response is cached for 5 minutes per account and date range. Use `generatedAt` to check how fresh the returned data is.
 *
 * @see ImageKit\Services\Accounts\UsageAnalyticsService::get()
 *
 * @phpstan-type UsageAnalyticsGetParamsShape = array{
 *   endDate: string, startDate: string
 * }
 */
final class UsageAnalyticsGetParams implements BaseModel
{
    /** @use SdkModel<UsageAnalyticsGetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Specify an `endDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Required]
    public string $endDate;

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Required]
    public string $startDate;

    /**
     * `new UsageAnalyticsGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageAnalyticsGetParams::with(endDate: ..., startDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageAnalyticsGetParams)->withEndDate(...)->withStartDate(...)
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
     * Specify an `endDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
