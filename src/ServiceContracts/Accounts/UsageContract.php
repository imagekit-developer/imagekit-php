<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Accounts;

use Imagekit\Accounts\Usage\UsageGetResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

interface UsageContract
{
    /**
     * @api
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
    ): UsageGetResponse;
}
