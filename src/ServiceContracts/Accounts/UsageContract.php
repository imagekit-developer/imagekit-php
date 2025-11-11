<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\Usage\UsageGetParams;
use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface UsageContract
{
    /**
     * @api
     *
     * @param array<mixed>|UsageGetParams $params
     *
     * @throws APIException
     */
    public function get(
        array|UsageGetParams $params,
        ?RequestOptions $requestOptions = null
    ): UsageGetResponse;
}
