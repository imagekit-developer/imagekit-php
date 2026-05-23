<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\CustomMetadataFields\CustomMetadataField;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\CustomMetadataFieldsContract;

/**
 * @phpstan-import-type SchemaShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema
 * @phpstan-import-type SchemaShape from \ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as SchemaShape1
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class CustomMetadataFieldsService implements CustomMetadataFieldsContract
{
    /**
     * @api
     */
    public CustomMetadataFieldsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomMetadataFieldsRawService($client);
    }

    /**
     * @api
     *
     * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
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
    ): CustomMetadataField {
        $params = Util::removeNulls(
            ['label' => $label, 'name' => $name, 'schema' => $schema]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API updates the label or schema of an existing custom metadata field.
     *
     * @param string $id should be a valid custom metadata field id
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param \ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema|SchemaShape1 $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $label = null,
        \ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema|array|null $schema = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomMetadataField {
        $params = Util::removeNulls(['label' => $label, 'schema' => $schema]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
     *
     * You can also filter results by a specific folder path to retrieve custom metadata fields applicable at that location. This path-specific filtering is useful when using the **Path policy** feature to determine which custom metadata fields are selected for a given path.
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
    ): array {
        $params = Util::removeNulls(
            ['folderPath' => $folderPath, 'includeDeleted' => $includeDeleted]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API deletes a custom metadata field. Even after deleting a custom metadata field, you cannot create any new custom metadata field with the same name.
     *
     * @param string $id should be a valid custom metadata field id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CustomMetadataFieldDeleteResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
