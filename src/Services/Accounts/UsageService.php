<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\Usage\UsageGetParams;
use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Accounts\UsageContract;

final class UsageService implements UsageContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
     *
     * @param array{
     *   endDate: string|\DateTimeInterface, startDate: string|\DateTimeInterface
     * }|UsageGetParams $params
     *
     * @throws APIException
     */
    public function get(
        array|UsageGetParams $params,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse {
        [$parsed, $options] = UsageGetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/usage',
            query: $parsed,
            options: $options,
            convert: UsageGetResponse::class,
        );
    }
}
