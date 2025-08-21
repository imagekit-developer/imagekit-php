<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Contracts\Files\BulkContract;
use ImageKit\Core\Conversion;
use ImageKit\Files\Bulk\BulkAddTagsParams;
use ImageKit\Files\Bulk\BulkDeleteParams;
use ImageKit\Files\Bulk\BulkRemoveAITagsParams;
use ImageKit\Files\Bulk\BulkRemoveTagsParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Responses\Files\Bulk\BulkDeleteResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Responses\Files\Bulk\BulkRemoveTagsResponse;

final class BulkService implements BulkContract
{
    public function __construct(private Client $client) {}

    /**
     * This API deletes multiple files and all their file versions permanently.
     *
     * Note: If a file or specific transformation has been requested in the past, then the response is cached. Deleting a file does not purge the cache. You can purge the cache using purge cache API.
     *
     * A maximum of 100 files can be deleted at a time.
     *
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     */
    public function delete(
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkDeleteResponse {
        $args = ['fileIDs' => $fileIDs];
        [$parsed, $options] = BulkDeleteParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/batch/deleteByFileIds',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkDeleteResponse::class, value: $resp);
    }

    /**
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     */
    public function addTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkAddTagsResponse {
        $args = ['fileIDs' => $fileIDs, 'tags' => $tags];
        [$parsed, $options] = BulkAddTagsParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/addTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkAddTagsResponse::class, value: $resp);
    }

    /**
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     */
    public function removeAITags(
        $aiTags,
        $fileIDs,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveAITagsResponse {
        $args = ['aiTags' => $aiTags, 'fileIDs' => $fileIDs];
        [$parsed, $options] = BulkRemoveAITagsParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeAITags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkRemoveAITagsResponse::class, value: $resp);
    }

    /**
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     */
    public function removeTags(
        $fileIDs,
        $tags,
        ?RequestOptions $requestOptions = null
    ): BulkRemoveTagsResponse {
        $args = ['fileIDs' => $fileIDs, 'tags' => $tags];
        [$parsed, $options] = BulkRemoveTagsParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/files/removeTags',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkRemoveTagsResponse::class, value: $resp);
    }
}
