<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Assets;

use ImageKit\Assets\Folders\FolderCreateParams;
use ImageKit\Assets\Folders\FolderNewResponse;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface FoldersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FolderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FolderNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|FolderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
