<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Accounts\UsageAnalyticsContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class UsageAnalyticsService implements UsageAnalyticsContract
{
    /**
     * @api
     */
    public UsageAnalyticsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageAnalyticsRawService($client);
    }

    /**
     * @api
     *
     * **Note:** This API is currently in beta.
     *
     * Get the account analytics data between two dates. The response covers the period from the start date to the end date, both dates inclusive. Both dates are interpreted as UTC calendar days.
     *
     * The returned data is scoped to the requesting account only. Unlike `/v1/accounts/usage`, an agency account's analytics are not aggregated across its child accounts.
     *
     * The response is cached for 5 minutes per account and date range. Use `generatedAt` to check how fresh the returned data is.
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
    ): UsageAnalyticsResponse {
        $params = Util::removeNulls(
            ['endDate' => $endDate, 'startDate' => $startDate]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
