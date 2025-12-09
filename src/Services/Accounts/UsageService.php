<?php

declare(strict_types=1);

namespace Imagekit\Services\Accounts;

use Imagekit\Accounts\Usage\UsageGetResponse;
use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\Accounts\UsageContract;

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
     * @param string|\DateTimeInterface $endDate Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param string|\DateTimeInterface $startDate Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     *
     * @throws APIException
     */
    public function get(
        string|\DateTimeInterface $endDate,
        string|\DateTimeInterface $startDate,
        ?RequestOptions $requestOptions = null,
    ): UsageGetResponse {
        $params = ['endDate' => $endDate, 'startDate' => $startDate];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
