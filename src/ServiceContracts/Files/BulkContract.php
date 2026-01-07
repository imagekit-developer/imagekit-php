<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts\Files;

use Imagekit\Core\Exceptions\APIException;
use Imagekit\Files\Bulk\BulkAddTagsResponse;
use Imagekit\Files\Bulk\BulkDeleteResponse;
use Imagekit\Files\Bulk\BulkRemoveAITagsResponse;
use Imagekit\Files\Bulk\BulkRemoveTagsResponse;
use Imagekit\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
interface BulkContract
{
    /**
     * @api
     *
     * @param list<string> $fileIDs an array of fileIds which you want to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        array $fileIDs,
        RequestOptions|array|null $requestOptions = null
    ): BulkDeleteResponse;

    /**
     * @api
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
    ): BulkAddTagsResponse;

    /**
     * @api
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
    ): BulkRemoveAITagsResponse;

    /**
     * @api
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
    ): BulkRemoveTagsResponse;
}
