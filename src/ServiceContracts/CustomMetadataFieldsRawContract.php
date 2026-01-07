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

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface CustomMetadataFieldsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CustomMetadataFieldCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomMetadataField>
     *
     * @throws APIException
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param array<string,mixed>|CustomMetadataFieldUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomMetadataField>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CustomMetadataFieldListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<CustomMetadataField>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomMetadataFieldDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
