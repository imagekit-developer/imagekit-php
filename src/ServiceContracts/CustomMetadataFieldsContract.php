<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\CustomMetadataFields\CustomMetadataFieldListParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use Imagekit\RequestOptions;

interface CustomMetadataFieldsContract
{
    /**
     * @api
     *
     * @param array<mixed>|CustomMetadataFieldCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param array<mixed>|CustomMetadataFieldUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param array<mixed>|CustomMetadataFieldListParams $params
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
