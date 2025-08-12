<?php

declare(strict_types=1);

namespace ImageKit\Files\Details;

use ImageKit\Client;
use ImageKit\Contracts\Files\DetailsContract;
use ImageKit\Core\Conversion;
use ImageKit\Files\Details\DetailUpdateParams\Extension\AutoTaggingExtension;
use ImageKit\Files\Details\DetailUpdateParams\Extension\RemovedotBgExtension;
use ImageKit\Files\Details\DetailUpdateParams\Publish;
use ImageKit\Files\Details\DetailUpdateParams\RemoveAITags\UnionMember1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Details\DetailGetResponse;
use ImageKit\Responses\Files\Details\DetailUpdateResponse;

final class DetailsService implements DetailsContract
{
    public function __construct(private Client $client) {}

    /**
     * This API returns an object with details or attributes about the current version of the file.
     */
    public function retrieve(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): DetailGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/files/%1$s/details', $fileID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DetailGetResponse::class, value: $resp);
    }

    /**
     * This API updates the details or attributes of the current version of the file. You can update `tags`, `customCoordinates`, `customMetadata`, publication status, remove existing `AITags` and apply extensions using this API.
     *
     * @param array{
     *   customCoordinates?: null|string,
     *   customMetadata?: mixed,
     *   extensions?: list<AutoTaggingExtension|RemovedotBgExtension>,
     *   removeAITags?: list<string>|UnionMember1::*,
     *   tags?: null|list<string>,
     *   webhookURL?: string,
     *   publish?: Publish,
     * }|DetailUpdateParams $params
     */
    public function update(
        string $fileID,
        array|DetailUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): DetailUpdateResponse {
        [$parsed, $options] = DetailUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['v1/files/%1$s/details', $fileID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DetailUpdateResponse::class, value: $resp);
    }
}
