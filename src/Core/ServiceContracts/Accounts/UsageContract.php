<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Accounts;

use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\RequestOptions;

interface UsageContract
{
    /**
     * @param \DateTimeInterface $endDate Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     * @param \DateTimeInterface $startDate Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function get(
        $endDate,
        $startDate,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse;
}
