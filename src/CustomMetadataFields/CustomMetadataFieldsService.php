<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Client;
use ImageKit\Contracts\CustomMetadataFieldsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as Schema1;
use ImageKit\RequestOptions;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldNewResponse;
use ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldUpdateResponse;

final class CustomMetadataFieldsService implements CustomMetadataFieldsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
     *
     * @param array{
     *   label: string, name: string, schema: Schema
     * }|CustomMetadataFieldCreateParams $params
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataFieldNewResponse {
        [$parsed, $options] = CustomMetadataFieldCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/customMetadataFields',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            CustomMetadataFieldNewResponse::class,
            value: $resp
        );
    }

    /**
     * This API updates the label or schema of an existing custom metadata field.
     *
     * @param array{
     *   label?: string, schema?: Schema1
     * }|CustomMetadataFieldUpdateParams $params
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataFieldUpdateResponse {
        [$parsed, $options] = CustomMetadataFieldUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['v1/customMetadataFields/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            CustomMetadataFieldUpdateResponse::class,
            value: $resp
        );
    }

    /**
     * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
     *
     * @param array{includeDeleted?: bool}|CustomMetadataFieldListParams $params
     *
     * @return list<CustomMetadataFieldListResponseItem>
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array {
        [$parsed, $options] = CustomMetadataFieldListParams::parseRequest(
            $params,
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
            new ListOf(CustomMetadataFieldListResponseItem::class),
            value: $resp
        );
    }

    /**
     * This API deletes a custom metadata field. Even after deleting a custom metadata field, you cannot create any new custom metadata field with the same name.
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $resp = $this->client->request(
            method: 'delete',
            path: ['v1/customMetadataFields/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce('mixed', value: $resp);
    }
}
