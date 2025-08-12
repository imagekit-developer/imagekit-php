<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\BulkJobs\BulkJobCopyFolderParams;
use ImageKit\BulkJobs\BulkJobMoveFolderParams;
use ImageKit\RequestOptions;
use ImageKit\Responses\BulkJobs\BulkJobCopyFolderResponse;
use ImageKit\Responses\BulkJobs\BulkJobGetStatusResponse;
use ImageKit\Responses\BulkJobs\BulkJobMoveFolderResponse;

interface BulkJobsContract
{
    /**
     * @param array{
     *   destinationPath: string, sourceFolderPath: string, includeVersions?: bool
     * }|BulkJobCopyFolderParams $params
     */
    public function copyFolder(
        array|BulkJobCopyFolderParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkJobCopyFolderResponse;

    /**
     * @param array{
     *   destinationPath: string, sourceFolderPath: string
     * }|BulkJobMoveFolderParams $params
     */
    public function moveFolder(
        array|BulkJobMoveFolderParams $params,
        ?RequestOptions $requestOptions = null,
    ): BulkJobMoveFolderResponse;

    public function retrieveStatus(
        string $jobID,
        ?RequestOptions $requestOptions = null
    ): BulkJobGetStatusResponse;
}
