<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AzureBlob;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\Gcs;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3Compatible;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebFolder;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebProxy;
use ImageKit\Accounts\Origins\OriginResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Accounts\Origins\OriginResponse\AzureBlob as AzureBlob2;
use ImageKit\Accounts\Origins\OriginResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Accounts\Origins\OriginResponse\Gcs as Gcs2;
use ImageKit\Accounts\Origins\OriginResponse\S3 as S32;
use ImageKit\Accounts\Origins\OriginResponse\S3Compatible as S3Compatible2;
use ImageKit\Accounts\Origins\OriginResponse\WebFolder as WebFolder2;
use ImageKit\Accounts\Origins\OriginResponse\WebProxy as WebProxy2;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AzureBlob as AzureBlob1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\Gcs as Gcs1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3 as S31;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebProxy as WebProxy1;
use ImageKit\RequestOptions;

interface OriginsContract
{
    /**
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|Gcs|AzureBlob|AkeneoPim $origin schema for origin request resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2;

    /**
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 $origin schema for origin request resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2;

    /**
     * @return list<S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2>
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
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2;
}
