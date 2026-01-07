<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type SchemaShape from \Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema
 * @phpstan-import-type SchemaShape from \Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as SchemaShape1
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface CustomMetadataFieldsContract
{
    /**
     * @api
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     * @param string $name API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     * @param Schema|SchemaShape $schema
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $label,
        string $name,
        Schema|array $schema,
        RequestOptions|array|null $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param \Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema|SchemaShape1 $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $label = null,
        \Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema|array|null $schema = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param string $folderPath The folder path (e.g., `/path/to/folder`) for which to retrieve applicable custom metadata fields. Useful for determining path-specific field selections when the [Path policy](https://imagekit.io/docs/dam/path-policy) feature is in use.
     * @param bool $includeDeleted set it to `true` to include deleted field objects in the API response
     * @param RequestOpts|null $requestOptions
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function list(
        ?string $folderPath = null,
        bool $includeDeleted = false,
        RequestOptions|array|null $requestOptions = null,
    ): array;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
