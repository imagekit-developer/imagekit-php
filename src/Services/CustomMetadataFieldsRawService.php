<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\CustomMetadataFields\CustomMetadataFieldListParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\CustomMetadataFieldsRawContract;

/**
 * @phpstan-import-type SchemaShape from \Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema
 * @phpstan-import-type SchemaShape from \Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams\Schema as SchemaShape1
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
final class CustomMetadataFieldsRawService implements CustomMetadataFieldsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API creates a new custom metadata field. Once a custom metadata field is created either through this API or using the dashboard UI, its value can be set on the assets. The value of a field for an asset can be set using the media library UI or programmatically through upload or update assets API.
     *
     * @param array{
     *   label: string, name: string, schema: Schema|SchemaShape
     * }|CustomMetadataFieldCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomMetadataField>
     *
     * @throws APIException
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomMetadataFieldCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/customMetadataFields',
            body: (object) $parsed,
            options: $options,
            convert: CustomMetadataField::class,
        );
    }

    /**
     * @api
     *
     * This API updates the label or schema of an existing custom metadata field.
     *
     * @param string $id should be a valid custom metadata field id
     * @param array{
     *   label?: string,
     *   schema?: CustomMetadataFieldUpdateParams\Schema|SchemaShape1,
     * }|CustomMetadataFieldUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = CustomMetadataFieldUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['v1/customMetadataFields/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: CustomMetadataField::class,
        );
    }

    /**
     * @api
     *
     * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
     *
     * You can also filter results by a specific folder path to retrieve custom metadata fields applicable at that location. This path-specific filtering is useful when using the **Path policy** feature to determine which custom metadata fields are selected for a given path.
     *
     * @param array{
     *   folderPath?: string, includeDeleted?: bool
     * }|CustomMetadataFieldListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<CustomMetadataField>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomMetadataFieldListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/customMetadataFields',
            query: $parsed,
            options: $options,
            convert: new ListOf(CustomMetadataField::class),
        );
    }

    /**
     * @api
     *
     * This API deletes a custom metadata field. Even after deleting a custom metadata field, you cannot create any new custom metadata field with the same name.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['v1/customMetadataFields/%1$s', $id],
            options: $requestOptions,
            convert: CustomMetadataFieldDeleteResponse::class,
        );
    }
}
