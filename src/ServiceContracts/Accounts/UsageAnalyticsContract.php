<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface UsageAnalyticsContract
{
    /**
     * @api
     *
     * @param string $endDate Specify an `endDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param string $startDate Specify a `startDate` in `YYYY-MM-DD` format, interpreted as a UTC calendar day. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $endDate,
        string $startDate,
        RequestOptions|array|null $requestOptions = null,
    ): UsageAnalyticsResponse;
}
