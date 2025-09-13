<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\RequestOptions;

interface UsageContract
{
    /**
     * @api
     *
     * @param \DateTimeInterface $endDate Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param \DateTimeInterface $startDate Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     *
     * @return UsageGetResponse<HasRawResponse>
     */
    public function get(
        $endDate,
        $startDate,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse;
}
