<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\Origin\AzureBlob;
use ImageKit\Accounts\Origins\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\Origin\Gcs;
use ImageKit\Accounts\Origins\Origin\S3;
use ImageKit\Accounts\Origins\Origin\S3Compatible;
use ImageKit\Accounts\Origins\Origin\WebFolder;
use ImageKit\Accounts\Origins\Origin\WebProxy;
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
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;

    /**
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;

    /**
     * @return list<S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1>
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1;
}
