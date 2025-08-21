<?php

declare(strict_types=1);

namespace ImageKit\Services\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\AkamaiURLRewriter as AkamaiURLRewriter1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter as CloudinaryURLRewriter1;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\ImgixURLRewriter as ImgixURLRewriter1;
use ImageKit\Client;
use ImageKit\Contracts\Accounts\URLEndpointsContract;
use ImageKit\Core\Conversion;
use ImageKit\Core\Conversion\ListOf;
use ImageKit\Core\Util;
use ImageKit\RequestOptions;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointGetResponse;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointListResponseItem;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointNewResponse;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointUpdateResponse;

final class URLEndpointsService implements URLEndpointsContract
{
    public function __construct(private Client $client) {}

    /**
     * **Note:** This API is currently in beta.
     * Creates a new URL‑endpoint and returns the resulting object.
     *
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
    ): URLEndpointNewResponse {
        $args = [
            'description' => $description,
            'origins' => $origins,
            'urlPrefix' => $urlPrefix,
            'urlRewriter' => $urlRewriter,
        ];
        $args = Util::array_filter_null(
            $args,
            ['origins', 'urlPrefix', 'urlRewriter']
        );
        [$parsed, $options] = URLEndpointCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/accounts/url-endpoints',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(URLEndpointNewResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Updates the URL‑endpoint identified by `id` and returns the updated object.
     *
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
    ): URLEndpointUpdateResponse {
        $args = [
            'description' => $description,
            'origins' => $origins,
            'urlPrefix' => $urlPrefix,
            'urlRewriter' => $urlRewriter,
        ];
        $args = Util::array_filter_null(
            $args,
            ['origins', 'urlPrefix', 'urlRewriter']
        );
        [$parsed, $options] = URLEndpointUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['v1/accounts/url-endpoints/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(URLEndpointUpdateResponse::class, value: $resp);
    }

    /**
     * **Note:** This API is currently in beta.
     * Returns an array of all URL‑endpoints configured including the default URL-endpoint generated by ImageKit during account creation.
     *
     * @return list<URLEndpointListResponseItem>
     */
    public function list(?RequestOptions $requestOptions = null): array
    {
        $resp = $this->client->request(
            method: 'get',
            path: 'v1/accounts/url-endpoints',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(URLEndpointListResponseItem::class),
            value: $resp
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Deletes the URL‑endpoint identified by `id`. You cannot delete the default URL‑endpoint created by ImageKit during account creation.
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['v1/accounts/url-endpoints/%1$s', $id],
            options: $requestOptions,
        );
    }

    /**
     * **Note:** This API is currently in beta.
     * Retrieves the URL‑endpoint identified by `id`.
     */
    public function get(
        string $id,
        ?RequestOptions $requestOptions = null
    ): URLEndpointGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/accounts/url-endpoints/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(URLEndpointGetResponse::class, value: $resp);
    }
}
