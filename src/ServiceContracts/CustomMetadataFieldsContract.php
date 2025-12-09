<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema\Type;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\RequestOptions;

interface CustomMetadataFieldsContract
{
    /**
     * @api
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     * @param string $name API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     * @param array{
     *   type: 'Text'|'Textarea'|'Number'|'Date'|'Boolean'|'SingleSelect'|'MultiSelect'|Type,
     *   defaultValue?: mixed,
     *   isValueRequired?: bool,
     *   maxLength?: float,
     *   maxValue?: string|float,
     *   minLength?: float,
     *   minValue?: string|float,
     *   selectOptions?: list<string|float|bool>,
     * } $schema
     *
     * @throws APIException
     */
    public function create(
        string $label,
        string $name,
        array $schema,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param array{
     *   defaultValue?: mixed,
     *   isValueRequired?: bool,
     *   maxLength?: float,
     *   maxValue?: string|float,
     *   minLength?: float,
     *   minValue?: string|float,
     *   selectOptions?: list<string|float|bool>,
     * } $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $label = null,
        ?array $schema = null,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField;

    /**
     * @api
     *
     * @param string $folderPath The folder path (e.g., `/path/to/folder`) for which to retrieve applicable custom metadata fields. Useful for determining path-specific field selections when the [Path policy](https://imagekit.io/docs/dam/path-policy) feature is in use.
     * @param bool $includeDeleted set it to `true` to include deleted field objects in the API response
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function list(
        ?string $folderPath = null,
        bool $includeDeleted = false,
        ?RequestOptions $requestOptions = null,
    ): array;

    /**
     * @api
     *
     * @param string $id should be a valid custom metadata field id
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse;
}
