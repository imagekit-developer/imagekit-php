<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Beta\V2;

use ImageKit\Beta\V2\Files\FileUploadParams;
use ImageKit\Beta\V2\Files\FileUploadParams\ResponseField;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation;
use ImageKit\RequestOptions;
use ImageKit\Responses\Beta\V2\Files\FileUploadResponse;
use ImageKit\Shared\AutoDescriptionExtension;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;

interface FilesContract
{
    /**
     * @param array{
     *   file: string,
     *   fileName: string,
     *   token?: string,
     *   checks?: string,
     *   customCoordinates?: string,
     *   customMetadata?: array<string, mixed>,
     *   description?: string,
     *   extensions?: list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwriteAITags?: bool,
     *   overwriteCustomMetadata?: bool,
     *   overwriteFile?: bool,
     *   overwriteTags?: bool,
     *   responseFields?: list<ResponseField::*>,
     *   tags?: list<string>,
     *   transformation?: Transformation,
     *   useUniqueFileName?: bool,
     *   webhookURL?: string,
     * }|FileUploadParams $params
     */
    public function upload(
        array|FileUploadParams $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadResponse;
}
