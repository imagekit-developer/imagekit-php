<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\AzureBlobStorage;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\GoogleCloudStorageGcs;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3Compatible;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebFolder;
use ImageKit\Accounts\Origins\OriginCreateParams\Origin\WebProxy;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AzureBlobStorage as AzureBlobStorage1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\GoogleCloudStorageGcs as GoogleCloudStorageGcs1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3 as S31;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebProxy as WebProxy1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlobStorage as AzureBlobStorage5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S35;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder5;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy5;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlobStorage as AzureBlobStorage2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\GoogleCloudStorageGcs as GoogleCloudStorageGcs2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy as WebProxy2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlobStorage as AzureBlobStorage3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S33;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder3;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlobStorage as AzureBlobStorage4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\GoogleCloudStorageGcs as GoogleCloudStorageGcs4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3 as S34;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible as S3Compatible4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder as WebFolder4;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy as WebProxy4;

interface OriginsContract
{
    /**
     * @param S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|GoogleCloudStorageGcs3|AzureBlobStorage3|AkeneoPim3;

    /**
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|GoogleCloudStorageGcs1|AzureBlobStorage1|AkeneoPim1 $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S34|S3Compatible4|CloudinaryBackup4|WebFolder4|WebProxy4|GoogleCloudStorageGcs4|AzureBlobStorage4|AkeneoPim4;

    /**
     * @return list<S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|GoogleCloudStorageGcs2|AzureBlobStorage2|AkeneoPim2>
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
    ): S35|S3Compatible5|CloudinaryBackup5|WebFolder5|WebProxy5|GoogleCloudStorageGcs5|AzureBlobStorage5|AkeneoPim5;
}
