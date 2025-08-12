<?php

declare(strict_types=1);

namespace ImageKit\BulkJobs;

use ImageKit\Client;
use ImageKit\Contracts\BulkJobsContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;
use ImageKit\Responses\BulkJobs\BulkJobCopyFolderResponse;
use ImageKit\Responses\BulkJobs\BulkJobGetStatusResponse;
use ImageKit\Responses\BulkJobs\BulkJobMoveFolderResponse;

final class BulkJobsService implements BulkJobsContract
{
    public function __construct(private Client $client) {}

    /**
     * This will copy one folder into another. The selected folder, its nested folders, files, and their versions (in `includeVersions` is set to true) are copied in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
     * }|BulkJobCopyFolderParams $params
     */
    public function copyFolder(
        array|BulkJobCopyFolderParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkJobCopyFolderResponse {
        [$parsed, $options] = BulkJobCopyFolderParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/copyFolder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkJobCopyFolderResponse::class, value: $resp);
    }

    /**
     * This will move one folder into another. The selected folder, its nested folders, files, and their versions are moved in this operation. Note: If any file at the destination has the same name as the source file, then the source file and its versions will be appended to the destination file version history.
     *
     * @param array{
     *   destinationPath: string, sourceFolderPath: string
     * }|BulkJobMoveFolderParams $params
     */
    public function moveFolder(
        array|BulkJobMoveFolderParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkJobMoveFolderResponse {
        [$parsed, $options] = BulkJobMoveFolderParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/bulkJobs/moveFolder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkJobMoveFolderResponse::class, value: $resp);
    }

    /**
     * This API returns the status of a bulk job like copy and move folder operations.
     */
    public function retrieveStatus(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkJobGetStatusResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['v1/bulkJobs/%1$s', $jobID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BulkJobGetStatusResponse::class, value: $resp);
    }
}
