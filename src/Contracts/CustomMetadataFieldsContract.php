<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldListParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as Schema1;
use ImageKit\RequestOptions;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldNewResponse;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldUpdateResponse;

interface CustomMetadataFieldsContract
{
    /**
     * @param array{
     *   label: string, name: string, schema: Schema
     * }|CustomMetadataFieldCreateParams $params
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataFieldNewResponse;

    /**
     * @param array{
     *   label?: string, schema?: Schema1
     * }|CustomMetadataFieldUpdateParams $params
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataFieldUpdateResponse;

    /**
     * @param array{includeDeleted?: bool}|CustomMetadataFieldListParams $params
     *
     * @return list<CustomMetadataFieldListResponseItem>
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
