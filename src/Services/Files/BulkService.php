<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Implementation\HasRawResponse;
use ImageKit\Files\Bulk\BulkAddTagsParams;
use ImageKit\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Files\Bulk\BulkDeleteParams;
use ImageKit\Files\Bulk\BulkDeleteResponse;
use ImageKit\Files\Bulk\BulkRemoveAITagsParams;
use ImageKit\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Files\Bulk\BulkRemoveTagsParams;
use ImageKit\Files\Bulk\BulkRemoveTagsResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Files\BulkContract;

final class BulkService implements BulkContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This API deletes multiple files and all their file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * A maximum of 100 files can be deleted at a time.
     *
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     *
     * @return BulkDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function delete(
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse {
        $params = ['fileIDs' => $fileIDs];

        return $this->deleteRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return BulkDeleteResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function deleteRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse {
        [$parsed, $options] = BulkDeleteParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/files/batch/deleteByFileIds',
            body: (object) $parsed,
            options: $options,
            convert: BulkDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     *
     * @return BulkAddTagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function addTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse {
        $params = ['fileIDs' => $fileIDs, 'tags' => $tags];

        return $this->addTagsRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return BulkAddTagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function addTagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse {
        [$parsed, $options] = BulkAddTagsParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/files/addTags',
            body: (object) $parsed,
            options: $options,
            convert: BulkAddTagsResponse::class,
        );
    }

    /**
     * @api
     *
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     *
     * @return BulkRemoveAITagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function removeAITags(
        $aiTags,
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse {
        $params = ['aiTags' => $aiTags, 'fileIDs' => $fileIDs];

        return $this->removeAITagsRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return BulkRemoveAITagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function removeAITagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse {
        [$parsed, $options] = BulkRemoveAITagsParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/files/removeAITags',
            body: (object) $parsed,
            options: $options,
            convert: BulkRemoveAITagsResponse::class,
        );
    }

    /**
     * @api
     *
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     *
     * @return BulkRemoveTagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function removeTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse {
        $params = ['fileIDs' => $fileIDs, 'tags' => $tags];

        return $this->removeTagsRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return BulkRemoveTagsResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function removeTagsRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse {
        [$parsed, $options] = BulkRemoveTagsParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'v1/files/removeTags',
            body: (object) $parsed,
            options: $options,
            convert: BulkRemoveTagsResponse::class,
        );
    }
}
