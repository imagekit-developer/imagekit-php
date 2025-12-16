<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\CustomMetadataFields\CustomMetadataFieldListParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use Imagekit\RequestOptions;

interface CustomMetadataFieldsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CustomMetadataFieldCreateParams $params
     *
     * @return BaseResponse<CustomMetadataField>
     *
     * @throws APIException
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param array<string,mixed>|CustomMetadataFieldUpdateParams $params
     *
     * @return BaseResponse<CustomMetadataField>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CustomMetadataFieldListParams $params
     *
     * @return BaseResponse<list<CustomMetadataField>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     *
     * @return BaseResponse<CustomMetadataFieldDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
