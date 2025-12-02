<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointResponse;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\RequestOptions;

interface URLEndpointsContract
{
    /**
     * @api
     *
     * @param array<mixed>|URLEndpointCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|URLEndpointCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @param array<mixed>|URLEndpointUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|URLEndpointUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @return list<URLEndpointResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): array;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;
}
