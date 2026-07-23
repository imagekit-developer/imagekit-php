<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Accounts\UsageContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class UsageService implements UsageContract
{
    /**
     * @api
     */
    public UsageRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsageRawService($client);
    }

    /**
     * @api
     *
     * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
     *
     * For an agency account, the returned usage is aggregated across the agency and all of its child accounts that are billed to it.
     *
     * The response is cached for 6 hours per account, date range and requested metrics.
     *
     * @param string $endDate Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param string $startDate Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $endDate,
        string $startDate,
        RequestOptions|array|null $requestOptions = null,
    ): UsageGetResponse {
        $params = Util::removeNulls(
            ['endDate' => $endDate, 'startDate' => $startDate]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
