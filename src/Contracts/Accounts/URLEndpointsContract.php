<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\AkamaiURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\ImgixURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams;
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
     * @param array{
     *   description: string,
     *   origins?: list<string>,
     *   urlPrefix?: string,
     *   urlRewriter?: AkamaiURLRewriter|CloudinaryURLRewriter|ImgixURLRewriter,
     * }|URLEndpointCreateParams $params
     */
    public function create(
        array|URLEndpointCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): URLEndpointNewResponse;

    /**
     * @param array{
     *   description: string,
     *   origins?: list<string>,
     *   urlPrefix?: string,
     *   urlRewriter?: AkamaiURLRewriter1|CloudinaryURLRewriter1|ImgixURLRewriter1,
     * }|URLEndpointUpdateParams $params
     */
    public function update(
        string $id,
        array|URLEndpointUpdateParams $params,
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
