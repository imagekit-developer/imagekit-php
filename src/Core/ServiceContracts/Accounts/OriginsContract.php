<?php

declare(strict_types=1);

namespace ImageKit\Core\ServiceContracts\Accounts;

use ImageKit\Accounts\Origins\OriginRequest\AkeneoPim;
use ImageKit\Accounts\Origins\OriginRequest\AzureBlob;
use ImageKit\Accounts\Origins\OriginRequest\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginRequest\Gcs;
use ImageKit\Accounts\Origins\OriginRequest\S3;
use ImageKit\Accounts\Origins\OriginRequest\S3Compatible;
use ImageKit\Accounts\Origins\OriginRequest\WebFolder;
use ImageKit\Accounts\Origins\OriginRequest\WebProxy;
use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob as AzureBlob1;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\OriginResponse\Gcs as Gcs1;
use ImageKit\Accounts\Origins\OriginResponse\S3 as S31;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy as WebProxy1;
use ImageKit\RequestOptions;

interface OriginsContract
{
    /**
     * @api
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin request resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;

    /**
     * @api
     *
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin request resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;

    /**
     * @api
     *
     * @return list<S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1>
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;
}
