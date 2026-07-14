<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsGetParams;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface UsageAnalyticsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UsageAnalyticsGetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UsageAnalyticsResponse>
     *
     * @throws APIException
     */
    public function get(
        array|UsageAnalyticsGetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
