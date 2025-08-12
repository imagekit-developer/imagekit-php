<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Purge\PurgeExecuteParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Purge\PurgeExecuteResponse;
use ImageKit\Responses\Files\Purge\PurgeStatusResponse;

interface PurgeContract
{
    /**
     * @param array{url: string}|PurgeExecuteParams $params
     */
    public function execute(
        array|PurgeExecuteParams $params,
        ?RequestOptions $requestOptions = null
    ): PurgeExecuteResponse;

    public function status(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): PurgeStatusResponse;
}
