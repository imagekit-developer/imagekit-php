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
use ImageKit\RequestOptions;

interface OriginsContract
{
    /**
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;

    /**
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim>
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
    ): S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim;
}
