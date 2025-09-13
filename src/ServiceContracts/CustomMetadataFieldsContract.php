<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\CustomMetadataFields\CustomMetadataField;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as Schema1;
use ImageKit\RequestOptions;

use const ImageKit\Core\OMIT as omit;

interface CustomMetadataFieldsContract
{
    /**
     * @api
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     * @param string $name API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     * @param Schema $schema
     *
     * @return CustomMetadataField<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $label,
        $name,
        $schema,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return CustomMetadataField<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param Schema1 $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     *
     * @return CustomMetadataField<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $label = omit,
        $schema = omit,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return CustomMetadataField<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param bool $includeDeleted set it to `true` to include deleted field objects in the API response
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function list(
        $includeDeleted = omit,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @return CustomMetadataFieldDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;

    /**
     * @api
     *
     * @return CustomMetadataFieldDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
