<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Akamai;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Cloudinary;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\Imgix;
use ImageKit\Accounts\URLEndpoints\URLEndpointResponse;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Akamai as Akamai1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Cloudinary as Cloudinary1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\Imgix as Imgix1;
use ImageKit\RequestOptions;

interface URLEndpointsContract
{
    /**
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param Cloudinary|Imgix|Akamai $urlRewriter configuration for third-party URL rewriting
     */
    public function create(
        $description,
        $origins = null,
        $urlPrefix = null,
        $urlRewriter = null,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param Cloudinary1|Imgix1|Akamai1 $urlRewriter configuration for third-party URL rewriting
     */
    public function update(
        string $id,
        $description,
        $origins = null,
        $urlPrefix = null,
        $urlRewriter = null,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointResponse;

    /**
     * @return list<URLEndpointResponse>
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): array;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): URLEndpointResponse;
}
