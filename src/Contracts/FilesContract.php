<?php

declare(strict_types=1);

namespace ImageKit\Contracts;

use ImageKit\Files\FileAddTagsParams;
use ImageKit\Files\FileCopyParams;
use ImageKit\Files\FileListParams;
use ImageKit\Files\FileListParams\Type;
use ImageKit\Files\FileMoveParams;
use ImageKit\Files\FileRemoveAITagsParams;
use ImageKit\Files\FileRemoveTagsParams;
use ImageKit\Files\FileRenameParams;
use ImageKit\Files\FileUploadV1Params;
use ImageKit\Files\FileUploadV1Params\IsPrivateFile;
use ImageKit\Files\FileUploadV1Params\IsPublished;
use ImageKit\Files\FileUploadV1Params\OverwriteAITags;
use ImageKit\Files\FileUploadV1Params\OverwriteCustomMetadata;
use ImageKit\Files\FileUploadV1Params\OverwriteTags;
use ImageKit\Files\FileUploadV1Params\UseUniqueFileName;
use ImageKit\Files\FileUploadV2Params;
use ImageKit\Files\FileUploadV2Params\IsPrivateFile as IsPrivateFile1;
use ImageKit\Files\FileUploadV2Params\IsPublished as IsPublished1;
use ImageKit\Files\FileUploadV2Params\OverwriteAITags as OverwriteAITags1;
use ImageKit\Files\FileUploadV2Params\OverwriteCustomMetadata as OverwriteCustomMetadata1;
use ImageKit\Files\FileUploadV2Params\OverwriteTags as OverwriteTags1;
use ImageKit\Files\FileUploadV2Params\UseUniqueFileName as UseUniqueFileName1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\FileAddTagsResponse;
use ImageKit\Responses\Files\FileListResponseItem;
use ImageKit\Responses\Files\FileRemoveAITagsResponse;
use ImageKit\Responses\Files\FileRemoveTagsResponse;
use ImageKit\Responses\Files\FileRenameResponse;
use ImageKit\Responses\Files\FileUploadV1Response;
use ImageKit\Responses\Files\FileUploadV2Response;

interface FilesContract
{
    /**
     * @param array{
     *   fileType?: string,
     *   limit?: string,
     *   path?: string,
     *   searchQuery?: string,
     *   skip?: string,
     *   sort?: string,
     *   type?: Type::*,
     * }|FileListParams $params
     *
     * @return list<FileListResponseItem>
     */
    public function list(
        array|FileListParams $params,
        ?RequestOptions $requestOptions = null
    ): array;

    public function delete(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|FileAddTagsParams $params
     */
    public function addTags(
        array|FileAddTagsParams $params,
        ?RequestOptions $requestOptions = null
    ): FileAddTagsResponse;

    /**
     * @param array{
     *   destinationPath: string, sourceFilePath: string, includeFileVersions?: bool
     * }|FileCopyParams $params
     */
    public function copy(
        array|FileCopyParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

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
     *   aiTags: list<string>, fileIDs: list<string>
     * }|FileRemoveAITagsParams $params
     */
    public function removeAITags(
        array|FileRemoveAITagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): FileRemoveAITagsResponse;

    /**
     * @param array{
     *   fileIDs: list<string>, tags: list<string>
     * }|FileRemoveTagsParams $params
     */
    public function removeTags(
        array|FileRemoveTagsParams $params,
        ?RequestOptions $requestOptions = null,
    ): FileRemoveTagsResponse;

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
     *   customMetadata?: string,
     *   expire?: string,
     *   extensions?: string,
     *   folder?: string,
     *   isPrivateFile?: IsPrivateFile::*,
     *   isPublished?: IsPublished::*,
     *   overwriteAITags?: OverwriteAITags::*,
     *   overwriteCustomMetadata?: OverwriteCustomMetadata::*,
     *   overwriteFile?: string,
     *   overwriteTags?: OverwriteTags::*,
     *   publicKey?: string,
     *   responseFields?: string,
     *   signature?: string,
     *   tags?: string,
     *   transformation?: string,
     *   useUniqueFileName?: UseUniqueFileName::*,
     *   webhookURL?: string,
     * }|FileUploadV1Params $params
     */
    public function uploadV1(
        array|FileUploadV1Params $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadV1Response;

    /**
     * @param array{
     *   file: string,
     *   fileName: string,
     *   token?: string,
     *   checks?: string,
     *   customCoordinates?: string,
     *   customMetadata?: string,
     *   extensions?: string,
     *   folder?: string,
     *   isPrivateFile?: IsPrivateFile1::*,
     *   isPublished?: IsPublished1::*,
     *   overwriteAITags?: OverwriteAITags1::*,
     *   overwriteCustomMetadata?: OverwriteCustomMetadata1::*,
     *   overwriteFile?: string,
     *   overwriteTags?: OverwriteTags1::*,
     *   responseFields?: string,
     *   tags?: string,
     *   transformation?: string,
     *   useUniqueFileName?: UseUniqueFileName1::*,
     *   webhookURL?: string,
     * }|FileUploadV2Params $params
     */
    public function uploadV2(
        array|FileUploadV2Params $params,
        ?RequestOptions $requestOptions = null
    ): FileUploadV2Response;
}
