<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\AkamaiURLRewriter as AkamaiURLRewriter1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter as CloudinaryURLRewriter1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter as ImgixURLRewriter1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointGetResponse;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointNewResponse;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse;

interface URLEndpointsContract
{
    /**
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param CloudinaryURLRewriter|ImgixURLRewriter|AkamaiURLRewriter $urlRewriter configuration for third-party URL rewriting
     */
    public function create(
        $description,
        $origins = null,
        $urlPrefix = null,
        $urlRewriter = null,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointNewResponse;

    /**
     * @param string $description description of the URL endpoint
     * @param list<string> $origins Ordered list of origin IDs to try when the file isn’t in the Media Library; ImageKit checks them in the sequence provided. Origin must be created before it can be used in a URL endpoint.
     * @param string $urlPrefix path segment appended to your base URL to form the endpoint (letters, digits, and hyphens only — or empty for the default endpoint)
     * @param CloudinaryURLRewriter1|ImgixURLRewriter1|AkamaiURLRewriter1 $urlRewriter configuration for third-party URL rewriting
     */
    public function update(
        string $id,
        $description,
        $origins = null,
        $urlPrefix = null,
        $urlRewriter = null,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointUpdateResponse;

    /**
     * @return list<URLEndpointListResponseItem>
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
    ): URLEndpointGetResponse;
}
