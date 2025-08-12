<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Accounts\AccountGetUsageParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\AccountGetUsageResponse;

interface AccountsContract
{
    /**
     * @param AccountGetUsageParams|array{
     *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
     * } $params
     */
    public function getUsage(
        AccountGetUsageParams|array $params,
        ?RequestOptions $requestOptions = null,
    ): AccountGetUsageResponse;
}
