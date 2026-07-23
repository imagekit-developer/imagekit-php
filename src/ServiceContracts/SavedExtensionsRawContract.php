<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Contracts\BaseResponse;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;
use ImageKit\SavedExtension;
use ImageKit\SavedExtensions\SavedExtensionCreateParams;
use ImageKit\SavedExtensions\SavedExtensionUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface SavedExtensionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SavedExtensionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SavedExtension>
     *
     * @throws APIException
     */
    public function create(
        array|SavedExtensionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id the unique ID of the saved extension
     * @param array<string,mixed>|SavedExtensionUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<SavedExtension>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
