<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Accounts;

use Imagekit\Accounts\Usage\UsageGetParams;
use Imagekit\Accounts\Usage\UsageGetResponse;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

interface UsageRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|UsageGetParams $params
     *
     * @return BaseResponse<UsageGetResponse>
     *
     * @throws APIException
     */
    public function get(
        array|UsageGetParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
