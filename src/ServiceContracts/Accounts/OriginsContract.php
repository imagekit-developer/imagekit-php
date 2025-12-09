<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Accounts;

use Imagekit\Accounts\Origins\OriginCreateParams;
use Imagekit\Accounts\Origins\OriginResponse\AkeneoPim;
use Imagekit\Accounts\Origins\OriginResponse\AzureBlob;
use Imagekit\Accounts\Origins\OriginResponse\CloudinaryBackup;
use Imagekit\Accounts\Origins\OriginResponse\Gcs;
use Imagekit\Accounts\Origins\OriginResponse\S3;
use Imagekit\Accounts\Origins\OriginResponse\S3Compatible;
use Imagekit\Accounts\Origins\OriginResponse\WebFolder;
use Imagekit\Accounts\Origins\OriginResponse\WebProxy;
use Imagekit\Accounts\Origins\OriginUpdateParams;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\RequestOptions;

interface OriginsContract
{
    /**
     * @api
     *
     * @param array<mixed>|OriginCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|OriginCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @param array<mixed>|OriginUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|OriginUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @api
     *
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): array;

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
