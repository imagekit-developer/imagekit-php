<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginResponse\Gcs;
use ImageKit\Accounts\Origins\OriginResponse\S3;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface OriginsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function create(
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @throws APIException
     */
    public function update(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;
}
