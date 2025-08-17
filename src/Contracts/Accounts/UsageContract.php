<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Usage\UsageGetParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Usage\UsageGetResponse;

interface UsageContract
{
    /**
     * @param array{
     *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
     * }|UsageGetParams $params
     */
    public function get(
        array|UsageGetParams $params,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse;
}
