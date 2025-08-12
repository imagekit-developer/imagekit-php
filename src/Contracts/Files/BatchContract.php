<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Batch\BatchDeleteParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Batch\BatchDeleteResponse;

interface BatchContract
{
    /**
     * @param array{fileIDs: list<string>}|BatchDeleteParams $params
     */
    public function delete(
        array|BatchDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): BatchDeleteResponse;
}
