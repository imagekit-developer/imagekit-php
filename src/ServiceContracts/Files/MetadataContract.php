<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Files;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Files\Metadata;
use ImageKit\RequestOptions;

interface MetadataContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): Metadata;

    /**
     * @api
     *
     * @throws APIException
     */
    public function getRaw(
        string $fileID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): Metadata;

    /**
     * @api
     *
     * @param string $url Should be a valid file URL. It should be accessible using your ImageKit.io account.
     *
     * @throws APIException
     */
    public function getFromURL(
        $url,
        ?RequestOptions $requestOptions = null
    ): Metadata;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function getFromURLRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): Metadata;
}
