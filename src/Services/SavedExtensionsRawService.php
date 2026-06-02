<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\SavedExtension;
use ImageKit\SavedExtensions\SavedExtensionCreateParams;
use ImageKit\SavedExtensions\SavedExtensionUpdateParams;
use ImageKit\ServiceContracts\SavedExtensionsRawContract;

/**
 * @phpstan-import-type ExtensionConfigShape from \ImageKit\ExtensionConfig
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class SavedExtensionsRawService implements SavedExtensionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API creates a new saved extension. Saved extensions allow you to save complex extension configurations (like AI tasks) and reuse them by referencing the ID in upload or update file APIs.
     *
     * **Saved extension limit** \
     * You can create a maximum of 100 saved extensions per account.
     *
     * @param array{
     *   config: ExtensionConfigShape, description: string, name: string
     * }|SavedExtensionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SavedExtension>
     *
     * @throws APIException
     */
    public function create(
        array|SavedExtensionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SavedExtensionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v2/saved-extensions',
            body: (object) $parsed,
            options: $options,
            convert: SavedExtension::class,
        );
    }

    /**
     * @api
     *
     * This API updates an existing saved extension. You can update the name, description, or config.
     *
     * @param string $id the unique ID of the saved extension
     * @param array{
     *   config?: ExtensionConfigShape, description?: string, name?: string
     * }|SavedExtensionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SavedExtension>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|SavedExtensionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SavedExtensionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['v2/saved-extensions/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: SavedExtension::class,
        );
    }

    /**
     * @api
     *
     * This API returns an array of all saved extensions for your account. Saved extensions allow you to save complex extension configurations and reuse them by referencing them by ID in upload or update file APIs.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<SavedExtension>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v2/saved-extensions',
            options: $requestOptions,
            convert: new ListOf(SavedExtension::class),
        );
    }

    /**
     * @api
     *
     * This API deletes a saved extension permanently.
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
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
            path: ['v2/saved-extensions/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * This API returns details of a specific saved extension by ID.
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SavedExtension>
     *
     * @throws APIException
     */
    public function get(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v2/saved-extensions/%1$s', $id],
            options: $requestOptions,
            convert: SavedExtension::class,
        );
    }
}
