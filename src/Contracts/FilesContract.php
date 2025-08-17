<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Files\FileCopyParams;
use ImageKit\Files\FileMoveParams;
use ImageKit\Files\FileRenameParams;
use ImageKit\Files\FileUpdateParams;
use ImageKit\Files\FileUpdateParams\Extension\AutoDescriptionExtension;
use ImageKit\Files\FileUpdateParams\Extension\AutoTaggingExtension;
use ImageKit\Files\FileUpdateParams\Extension\RemovedotBgExtension;
use ImageKit\Files\FileUpdateParams\Publish;
use ImageKit\Files\FileUpdateParams\RemoveAITags\UnionMember1;
use ImageKit\Files\FileUploadParams;
use ImageKit\Files\FileUploadParams\Extension\AutoDescriptionExtension as AutoDescriptionExtension1;
use ImageKit\Files\FileUploadParams\Extension\AutoTaggingExtension as AutoTaggingExtension1;
use ImageKit\Files\FileUploadParams\Extension\RemovedotBgExtension as RemovedotBgExtension1;
use ImageKit\Files\FileUploadParams\ResponseField;
use ImageKit\Files\FileUploadParams\Transformation;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\FileGetResponse;
use ImageKit\Responses\Files\FileRenameResponse;
use ImageKit\Responses\Files\FileUpdateResponse;
use ImageKit\Responses\Files\FileUploadResponse;

interface FilesContract
{
    /**
     * @param array{
     *   customCoordinates?: null|string,
     *   customMetadata?: mixed,
     *   description?: string,
     *   extensions?: list<AutoDescriptionExtension|AutoTaggingExtension|RemovedotBgExtension>,
     *   removeAITags?: list<string>|UnionMember1::*,
     *   tags?: null|list<string>,
     *   webhookURL?: string,
     *   publish?: Publish,
     * }|FileUpdateParams $params
     */
    public function update(
        string $fileID,
        array|FileUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): FileUpdateResponse;

    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param array{
     *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
     * }|FileCopyParams $params
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function get(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): FileGetResponse;

    /**
     * @param array{
     *   destinationPath: string, sourceFilePath: string
     * }|FileMoveParams $params
     */
    public function move(
        array|FileMoveParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param array{
     *   filePath: string, newFileName: string, purgeCache?: bool
     * }|FileRenameParams $params
     */
    public function rename(
        array|FileRenameParams $params,
        ?RequestOptions $requestOptions = null
    ): FileRenameResponse;

    /**
     * @param array{
     *   file: string,
     *   fileName: string,
     *   token?: string,
     *   checks?: string,
     *   customCoordinates?: string,
     *   customMetadata?: array<string, mixed>,
     *   description?: string,
     *   expire?: int,
     *   extensions?: list<AutoDescriptionExtension1|AutoTaggingExtension1|RemovedotBgExtension1>,
     *   folder?: string,
     *   isPrivateFile?: bool,
     *   isPublished?: bool,
     *   overwriteAITags?: bool,
     *   overwriteCustomMetadata?: bool,
     *   overwriteFile?: bool,
     *   overwriteTags?: bool,
     *   publicKey?: string,
     *   responseFields?: list<ResponseField::*>,
     *   signature?: string,
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
