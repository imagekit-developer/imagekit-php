<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams;
use ImageKit\Accounts\Origins\OriginCreateParams\Type;
use ImageKit\Accounts\Origins\OriginUpdateParams;
use ImageKit\Accounts\Origins\OriginUpdateParams\Type as Type1;
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
     * @param array{
     *   accessKey: string,
     *   bucket: string,
     *   name: string,
     *   secretKey: string,
     *   type: Type::*,
     *   baseURLForCanonicalHeader?: string,
     *   includeCanonicalHeader?: bool,
     *   prefix?: string,
     *   endpoint: string,
     *   s3ForcePathStyle?: bool,
     *   baseURL: string,
     *   forwardHostHeaderToOrigin?: bool,
     *   clientEmail: string,
     *   privateKey: string,
     *   accountName: string,
     *   container: string,
     *   sasToken: string,
     *   clientID: string,
     *   clientSecret: string,
     *   password: string,
     *   username: string,
     * }|OriginCreateParams $params
     */
    public function create(
        array|OriginCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): AkeneoPim1|AzureBlobStorage1|CloudinaryBackup1|GoogleCloudStorageGcs1|S31|S3Compatible1|WebFolder1|WebProxy1;

    /**
     * @param array{
     *   accessKey: string,
     *   bucket: string,
     *   name: string,
     *   secretKey: string,
     *   type: Type1::*,
     *   baseURLForCanonicalHeader?: string,
     *   includeCanonicalHeader?: bool,
     *   prefix?: string,
     *   endpoint: string,
     *   s3ForcePathStyle?: bool,
     *   baseURL: string,
     *   forwardHostHeaderToOrigin?: bool,
     *   clientEmail: string,
     *   privateKey: string,
     *   accountName: string,
     *   container: string,
     *   sasToken: string,
     *   clientID: string,
     *   clientSecret: string,
     *   password: string,
     *   username: string,
     * }|OriginUpdateParams $params
     */
    public function update(
        string $id,
        array|OriginUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AkeneoPim2|AzureBlobStorage2|CloudinaryBackup2|GoogleCloudStorageGcs2|S32|S3Compatible2|WebFolder2|WebProxy2;

    /**
     * @return list<AkeneoPim|AzureBlobStorage|CloudinaryBackup|GoogleCloudStorageGcs|S3|S3Compatible|WebFolder|WebProxy>
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
    ): AkeneoPim3|AzureBlobStorage3|CloudinaryBackup3|GoogleCloudStorageGcs3|S33|S3Compatible3|WebFolder3|WebProxy3;
}
