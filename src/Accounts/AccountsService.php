<?php

declare(strict_types=1);

namespace ImageKit\Accounts;

use ImageKit\Client;
use ImageKit\Contracts\AccountsContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\AccountGetUsageResponse;

final class AccountsService implements AccountsContract
{
    public function __construct(private Client $client) {}

    /**
     * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
     *
     * @param AccountGetUsageParams|array{
     *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
     * } $params
     */
    public function getUsage(
        AccountGetUsageParams|array $params,
        ?RequestOptions $requestOptions = null
    ): AccountGetUsageResponse {
        [$parsed, $options] = AccountGetUsageParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/accounts/usage',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AccountGetUsageResponse::class, value: $resp);
    }
}
