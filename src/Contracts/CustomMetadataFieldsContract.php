<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as Schema1;
use ImageKit\RequestOptions;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldNewResponse;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldUpdateResponse;

interface CustomMetadataFieldsContract
{
    /**
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     * @param string $name API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     * @param Schema $schema
     */
    public function create(
        $label,
        $name,
        $schema,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldNewResponse;

    /**
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param Schema1 $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     */
    public function update(
        string $id,
        $label = null,
        $schema = null,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataFieldUpdateResponse;

    /**
     * @param bool $includeDeleted set it to `true` to include deleted field objects in the API response
     *
     * @return list<CustomMetadataFieldListResponseItem>
     */
    public function list(
        $includeDeleted = null,
        ?RequestOptions $requestOptions = null
    ): array;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
