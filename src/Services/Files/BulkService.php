<?php

declare(strict_types=1);

namespace ImageKit\Services\Files;

use ImageKit\Client;
use ImageKit\Core\Exceptions\APIException;
use ImageKit\Core\Util;
use ImageKit\Files\Bulk\BulkAddTagsResponse;
use ImageKit\Files\Bulk\BulkDeleteResponse;
use ImageKit\Files\Bulk\BulkRemoveAITagsResponse;
use ImageKit\Files\Bulk\BulkRemoveTagsResponse;
use ImageKit\RequestOptions;
use ImageKit\ServiceContracts\Files\BulkContract;

/**
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }

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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        array $fileIDs,
        RequestOptions|array|null $requestOptions = null
    ): BulkDeleteResponse {
        $params = Util::removeNulls(['fileIDs' => $fileIDs]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API adds tags to multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds to which you want to add tags
     * @param list<string> $tags an array of tags that you want to add to the files
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addTags(
        array $fileIDs,
        array $tags,
        RequestOptions|array|null $requestOptions = null,
    ): BulkAddTagsResponse {
        $params = Util::removeNulls(['fileIDs' => $fileIDs, 'tags' => $tags]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->addTags(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API removes AITags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $aiTags an array of AITags that you want to remove from the files
     * @param list<string> $fileIDs an array of fileIds from which you want to remove AITags
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeAITags(
        array $aiTags,
        array $fileIDs,
        RequestOptions|array|null $requestOptions = null,
    ): BulkRemoveAITagsResponse {
        $params = Util::removeNulls(['aiTags' => $aiTags, 'fileIDs' => $fileIDs]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->removeAITags(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API removes tags from multiple files in bulk. A maximum of 50 files can be specified at a time.
     *
     * @param list<string> $fileIDs an array of fileIds from which you want to remove tags
     * @param list<string> $tags an array of tags that you want to remove from the files
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function removeTags(
        array $fileIDs,
        array $tags,
        RequestOptions|array|null $requestOptions = null,
    ): BulkRemoveTagsResponse {
        $params = Util::removeNulls(['fileIDs' => $fileIDs, 'tags' => $tags]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->removeTags(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
