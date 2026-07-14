<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsGetParams;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;
use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Accounts\UsageAnalyticsRawContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class UsageAnalyticsRawService implements UsageAnalyticsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{endDate: string, startDate: string}|UsageAnalyticsGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageAnalyticsResponse>
     *
     * @throws APIException
     */
    public function get(
        array|UsageAnalyticsGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = UsageAnalyticsGetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/usage-analytics',
            query: $parsed,
            options: $options,
            convert: UsageAnalyticsResponse::class,
        );
    }
}
