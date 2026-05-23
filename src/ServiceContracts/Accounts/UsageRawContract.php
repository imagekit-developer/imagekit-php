<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\Usage\UsageGetParams;
use ImageKit\Accounts\Usage\UsageGetResponse;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface UsageRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UsageGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageGetResponse>
     *
     * @throws APIException
     */
    public function get(
        array|UsageGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
