<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Akamai;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Cloudinary;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Imgix;
use ImageKit\Accounts\URLEndpoints\URLEndpointResponse;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Akamai as Akamai1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Cloudinary as Cloudinary1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Imgix as Imgix1;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\RequestOptions;

use const ImageKit\Core\OMIT as omit;

interface URLEndpointsContract
{
    /**
     * @api
     *
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param Cloudinary|Imgix|Akamai $urlRewriter configuration for third-party URL rewriting
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $description,
        $origins = omit,
        $urlPrefix = omit,
        $urlRewriter = omit,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param Cloudinary1|Imgix1|Akamai1 $urlRewriter configuration for third-party URL rewriting
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $description,
        $origins = omit,
        $urlPrefix = omit,
        $urlRewriter = omit,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @return list<URLEndpointResponse>
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @return list<URLEndpointResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): array;

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
    public function deleteRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;

    /**
     * @api
     *
     * @return URLEndpointResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;
}
