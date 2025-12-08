<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\Core\Contracts\BaseResponse;
use Imagekit\Core\Conversion\ListOf;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\CustomMetadataFields\CustomMetadataField;
use Imagekit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldDeleteResponse;
use Imagekit\CustomMetadataFields\CustomMetadataFieldListParams;
use Imagekit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use Imagekit\RequestOptions;
use Imagekit\ServiceContracts\CustomMetadataFieldsContract;

final class CustomMetadataFieldsService implements CustomMetadataFieldsContract
{
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
     *   label: string,
     *   name: string,
     *   schema: array{
     *     type: 'Text'|'Textarea'|'Number'|'Date'|'Boolean'|'SingleSelect'|'MultiSelect',
     *     defaultValue?: mixed,
     *     isValueRequired?: bool,
     *     maxLength?: float,
     *     maxValue?: string|float,
     *     minLength?: float,
     *     minValue?: string|float,
     *     selectOptions?: list<string|float|bool>,
     *   },
     * }|CustomMetadataFieldCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CustomMetadataFieldCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField {
        [$parsed, $options] = CustomMetadataFieldCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<CustomMetadataField> */
        $response = $this->client->request(
            method: 'post',
            path: 'v1/customMetadataFields',
            body: (object) $parsed,
            options: $options,
            convert: CustomMetadataField::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This API updates the label or schema of an existing custom metadata field.
     *
     * @param array{
     *   label?: string,
     *   schema?: array{
     *     defaultValue?: mixed,
     *     isValueRequired?: bool,
     *     maxLength?: float,
     *     maxValue?: string|float,
     *     minLength?: float,
     *     minValue?: string|float,
     *     selectOptions?: list<string|float|bool>,
     *   },
     * }|CustomMetadataFieldUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CustomMetadataFieldUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomMetadataField {
        [$parsed, $options] = CustomMetadataFieldUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<CustomMetadataField> */
        $response = $this->client->request(
            method: 'patch',
            path: ['v1/customMetadataFields/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: CustomMetadataField::class,
        );

        return $response->parse();
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
     *
     * @return list<CustomMetadataField>
     *
     * @throws APIException
     */
    public function list(
        array|CustomMetadataFieldListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array {
        [$parsed, $options] = CustomMetadataFieldListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<list<CustomMetadataField>> */
        $response = $this->client->request(
            method: 'get',
            path: 'v1/customMetadataFields',
            query: $parsed,
            options: $options,
            convert: new ListOf(CustomMetadataField::class),
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * This API deletes a custom metadata field. Even after deleting a custom metadata field, you cannot create any new custom metadata field with the same name.
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CustomMetadataFieldDeleteResponse {
        /** @var BaseResponse<CustomMetadataFieldDeleteResponse> */
        $response = $this->client->request(
            method: 'delete',
            path: ['v1/customMetadataFields/%1$s', $id],
            options: $requestOptions,
            convert: CustomMetadataFieldDeleteResponse::class,
        );

        return $response->parse();
    }
}
