<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\Origins\Origin\AkeneoPim as AkeneoPim1;
use ImageKit\Accounts\Origins\Origin\AzureBlob as AzureBlob1;
use ImageKit\Accounts\Origins\Origin\CloudinaryBackup as CloudinaryBackup1;
use ImageKit\Accounts\Origins\Origin\Gcs as Gcs1;
use ImageKit\Accounts\Origins\Origin\S3 as S31;
use ImageKit\Accounts\Origins\Origin\S3Compatible as S3Compatible1;
use ImageKit\Accounts\Origins\Origin\WebFolder as WebFolder1;
use ImageKit\Accounts\Origins\Origin\WebProxy as WebProxy1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AkeneoPim as AkeneoPim4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\AzureBlob as AzureBlob4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\CloudinaryBackup as CloudinaryBackup4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\Gcs as Gcs4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3 as S34;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\S3Compatible as S3Compatible4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebFolder as WebFolder4;
use ImageKit\Responses\Accounts\Origins\OriginGetResponse\WebProxy as WebProxy4;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AkeneoPim;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\AzureBlob;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\CloudinaryBackup;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\Gcs;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\S3Compatible;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebFolder;
use ImageKit\Responses\Accounts\Origins\OriginListResponseItem\WebProxy;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AkeneoPim as AkeneoPim2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\AzureBlob as AzureBlob2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\CloudinaryBackup as CloudinaryBackup2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\Gcs as Gcs2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3 as S32;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\S3Compatible as S3Compatible2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebFolder as WebFolder2;
use ImageKit\Responses\Accounts\Origins\OriginNewResponse\WebProxy as WebProxy2;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AkeneoPim as AkeneoPim3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\AzureBlob as AzureBlob3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\CloudinaryBackup as CloudinaryBackup3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\Gcs as Gcs3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3 as S33;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\S3Compatible as S3Compatible3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebFolder as WebFolder3;
use ImageKit\Responses\Accounts\Origins\OriginUpdateResponse\WebProxy as WebProxy3;

interface OriginsContract
{
    /**
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 $origin schema for origin resources
     */
    public function create(
        $origin,
        ?RequestOptions $requestOptions = null
    ): S32|S3Compatible2|CloudinaryBackup2|WebFolder2|WebProxy2|Gcs2|AzureBlob2|AkeneoPim2;

    /**
     * @param S31|S3Compatible1|CloudinaryBackup1|WebFolder1|WebProxy1|Gcs1|AzureBlob1|AkeneoPim1 $origin schema for origin resources
     */
    public function update(
        string $id,
        $origin,
        ?RequestOptions $requestOptions = null
    ): S33|S3Compatible3|CloudinaryBackup3|WebFolder3|WebProxy3|Gcs3|AzureBlob3|AkeneoPim3;

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
    ): S34|S3Compatible4|CloudinaryBackup4|WebFolder4|WebProxy4|Gcs4|AzureBlob4|AkeneoPim4;
}
