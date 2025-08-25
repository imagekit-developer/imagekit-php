<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Contracts\CustomMetadataFieldsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Util;
use ImageKit\CustomMetadataFields\CustomMetadataField;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldListParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as Schema1;
use ImageKit\RequestOptions;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldDeleteResponse;

final class CustomMetadataFieldsService implements CustomMetadataFieldsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI.
     * @param string $name API name of the custom metadata field. This should be unique across all (including deleted) custom metadata fields.
     * @param Schema $schema
     */
    public function create(
        $label,
        $name,
        $schema,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataField {
        $args = ['label' => $label, 'name' => $name, 'schema' => $schema];
        [$parsed, $options] = CustomMetadataFieldCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/customMetadataFields',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(CustomMetadataField::class, value: $resp);
    }

    /**
     * This API updates the label or schema of an existing custom metadata field.
     *
     * @param string $label Human readable name of the custom metadata field. This should be unique across all non deleted custom metadata fields. This name is displayed as form field label to the users while setting field value on an asset in the media library UI. This parameter is required if `schema` is not provided.
     * @param Schema1 $schema An object that describes the rules for the custom metadata key. This parameter is required if `label` is not provided. Note: `type` cannot be updated and will be ignored if sent with the `schema`. The schema will be validated as per the existing `type`.
     */
    public function update(
        string $id,
        $label = null,
        $schema = null,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField {
        $args = ['label' => $label, 'schema' => $schema];
        $args = Util::array_filter_null($args, ['label', 'schema']);
        [$parsed, $options] = CustomMetadataFieldUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['v1/customMetadataFields/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(CustomMetadataField::class, value: $resp);
    }

    /**
     * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
     *
     * @param bool $includeDeleted set it to `true` to include deleted field objects in the API response
     *
     * @return list<CustomMetadataField>
     */
    public function list(
        $includeDeleted = null,
        ?RequestOptions $requestOptions = null
    ): array {
        $args = ['includeDeleted' => $includeDeleted];
        $args = Util::array_filter_null($args, ['includeDeleted']);
        [$parsed, $options] = CustomMetadataFieldListParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/customMetadataFields',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(CustomMetadataField::class),
            value: $resp
        );
    }

    /**
     * This API deletes a custom metadata field. Even after deleting a custom metadata field, you cannot create any new custom metadata field with the same name.
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse {
        $resp = $this->client->request(
            method: 'delete',
            path: ['v1/customMetadataFields/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            CustomMetadataFieldDeleteResponse::class,
            value: $resp
        );
    }
}
