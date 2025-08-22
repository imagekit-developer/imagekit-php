<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams\Body;
use ImageKit\Accounts\Origins\OriginUpdateParams\Body as Body1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlobStorage as AzureBlobStorage3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S33;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder3;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlobStorage;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\GoogleCloudStorageGcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlobStorage as AzureBlobStorage1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S31;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder1;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy1;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlobStorage as AzureBlobStorage2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy as WebProxy2;

interface OriginsContract
{
    /**
     * @param Body $body
     */
    public function create(
        $body,
        ?RequestOptions $requestOptions = null
    ): S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|GoogleCloudStorageGcs1|AzureBlobStorage1|AkeneoPim1;

    /**
     * @param Body1 $body
     */
    public function update(
        string $id,
        $body,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|GoogleCloudStorageGcs2|AzureBlobStorage2|AkeneoPim2;

    /**
     * @return list<S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim>
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
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|GoogleCloudStorageGcs3|AzureBlobStorage3|AkeneoPim3;
}
