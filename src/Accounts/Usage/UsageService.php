<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Usage;

use ImageKit\Client;
use ImageKit\Contracts\Accounts\UsageContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Usage\UsageGetResponse;

final class UsageService implements UsageContract
{
    public function __construct(private Client $client) {}

    /**
     * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
     *
     * @param array{
     *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
     * }|UsageGetParams $params
     */
    public function get(
        array|UsageGetParams $params,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse {
        [$parsed, $options] = UsageGetParams::parseRequest(
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
        return Conversion::coerce(UsageGetResponse::class, value: $resp);
    }
}
