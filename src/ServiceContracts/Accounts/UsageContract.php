<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Accounts;

use Imagekit\Accounts\Usage\UsageGetParams;
use Imagekit\Accounts\Usage\UsageGetResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

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
