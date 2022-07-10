<?php

echo "\n\n------------------------------------------------------------";
echo "\n\n-------------------- File Management -----------------------";
echo "\n\n------------------------------------------------------------";
echo "\n";

// List All Files

$listFiles = $imageKit->listFiles();

echo "\n\n";
echo "1. List All Files: \n";
echo "\033[01;32m".print_r($listFiles,true)."\033[0m";
echo "\n";

$file_id = $listFiles->result[0]->fileId;
$version_id = $listFiles->result[0]->versionInfo->id;
$filePath = $listFiles->result[0]->filePath;
$sourceFilePath = $listFiles->result[0]->filePath;

// List Filtered Files

$listFilteredFiles = $imageKit->listFiles([
    "type" => "file",
    "sort" => "ASC_CREATED",    
    "path" => "/sample-folder",
    "fileType" => "all",
    "limit" => 10,
    "skip" => 0,
    "tags" => ["tag3","tag4"],
]);

echo "\n\n";
echo "2. List Filtered Files: \n";
echo "\033[01;32m".print_r($listFilteredFiles,true)."\033[0m";
echo "\n";

// Advance Search Filtered Files

$advanceSearchFilteredFiles = $imageKit->listFiles([
    "searchQuery" => '(size < "50kb" AND width > 500) OR (tags IN ["summer-sale","banner"])',
]);

echo "\n\n";
echo "3. Advance Search Filtered Files: \n";
echo "\033[01;32m".print_r($advanceSearchFilteredFiles,true)."\033[0m";
echo "\n";

// Get File Details
$getFileDetails = $imageKit->getFileDetails($file_id);

echo "\n\n";
echo "4. Get File Details: \n";
echo "\033[01;32m".print_r($getFileDetails,true)."\033[0m";
echo "\n";

// Get File Version Details
$getFileVersionDetails = $imageKit->getFileVersionDetails($file_id,$version_id);

echo "\n\n";
echo "5. Get File Version Details: \n";
echo "\033[01;32m".print_r($getFileVersionDetails,true)."\033[0m";
echo "\n";

// Get File Versions
$getFileVersions = $imageKit->getFileVersions($file_id);


echo "\n\n";
echo "6. Get File Versions: \n";
echo "\033[01;32m".print_r($getFileVersions,true)."\033[0m";
echo "\n";

// Update File Details
$updateData = [
    "removeAITags" => "all",    // "all" or ["tag1","tag2"]
    "webhookUrl" => "https://example.com/webhook",
    "tags" => ["tag3", "tag4"],
];

$updateFileDetails = $imageKit->updateFileDetails(
    $file_id,
    $updateData
);

echo "\n\n";
echo "7. Update File Details: \n";
echo "\033[01;32m".print_r($updateFileDetails,true)."\033[0m";
echo "\n";

// Add Tags (Bulk)
$fileIds = [$file_id];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkAddTags = $imageKit->bulkAddTags($fileIds, $tags);

echo "\n\n";
echo "8. Add Tags (Bulk): \n";
echo "\033[01;32m".print_r($bulkAddTags,true)."\033[0m";
echo "\n";

// Remove Tags (Bulk)
$fileIds = [$file_id];
$tags = ['image_tag_1', 'image_tag_2'];

$bulkRemoveTags = $imageKit->bulkRemoveTags($fileIds, $tags);

echo "\n\n";
echo "9. Remove Tags (Bulk): \n";
echo "\033[01;32m".print_r($bulkRemoveTags,true)."\033[0m";
echo "\n";

// Remove AI Tags (Bulk)
$fileIds = [$file_id];
$AITags = ['image_AITag_1', 'image_AITag_2'];

$bulkRemoveAITags = $imageKit->bulkRemoveAITags($fileIds, $AITags);

echo "\n\n";
echo "10. Remove AI Tags (Bulk): \n";
echo "\033[01;32m".print_r($bulkRemoveAITags,true)."\033[0m";
echo "\n";

// Copy File

$destinationPath = '/sample-folder2/';
$copyFile = $imageKit->copy([
    'sourceFilePath' => $sourceFilePath,
    'destinationPath' => $destinationPath,
    'includeFileVersions' => false
]);

echo "\n\n";
echo "11. Copy File: \n";
echo "\033[01;32m".print_r($copyFile,true)."\033[0m";
echo "\n";

// Move File

$destinationPath = '/';
$moveFile = $imageKit->move([
    'sourceFilePath' => '/sample-folder2/default-image.jpg',
    'destinationPath' => $destinationPath
]);

echo "\n\n";
echo "12. Move File: \n";
echo "\033[01;32m".print_r($moveFile,true)."\033[0m";
echo "\n";

// Rename File with purge cache false

$newFileName = 'sample-file2.jpg';
$renameFile = $imageKit->rename([
    'filePath' => $filePath,
    'newFileName' => $newFileName,
    'purgeCache' => false
]);

echo "\n\n";
echo "13. Rename File with Pruge Cache False: \n";
echo "\033[01;32m".print_r($renameFile,true)."\033[0m";
echo "\n";

// Rename File with Purge Cache true

$newFileName = 'sample-file3.jpg';
$renameFile = $imageKit->renameFile([
    'filePath' => $filePath,
    'newFileName' => $newFileName,
], true);

echo "\n\n";
echo "14. Rename File with Pruge Cache True: \n";
echo "\033[01;32m".print_r($renameFile,true)."\033[0m";
echo "\n";

// Restore File Version

$restoreFileVersion = $imageKit->restoreFileVersion([
    'fileId' => $file_id,
    'versionId' => $version_id,
]);

echo "\n\n";
echo "15. Restore File Version: \n";
echo "\033[01;32m".print_r($restoreFileVersion,true)."\033[0m";
echo "\n";

// Create Folder

$folderName = 'new-folder';
$parentFolderPath = '/';
$createFolder = $imageKit->createFolder([
    'folderName' => $folderName,
    'parentFolderPath' => $parentFolderPath,
]);

echo "\n\n";
echo "16. Create Folder: \n";
echo "\033[01;32m".print_r($createFolder,true)."\033[0m";
echo "\n";

// Copy Folder

$sourceFolderPath = $folderName;
$destinationPath = '/sample-folder';
$includeFileVersions = false;
$copyFolder = $imageKit->copyFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath,
    'includeFileVersions' => $includeFileVersions
]);

echo "\n\n";
echo "17. Copy Folder: \n";
echo "\033[01;32m".print_r($copyFolder,true)."\033[0m";
echo "\n";

// Move Folder

$sourceFolderPath = $folderName;
$destinationPath = '/sample-folder';
$moveFolder = $imageKit->moveFolder([
    'sourceFolderPath' => $sourceFolderPath,
    'destinationPath' => $destinationPath
]);

$job_id = $moveFolder->result->jobId;

echo "\n\n";
echo "18. Move Folder: \n";
echo "\033[01;32m".print_r($moveFolder,true)."\033[0m";
echo "\n";


// Delete Folder
$folderPath = '/sample-folder/new-folder';
$deleteFolder = $imageKit->deleteFolder($folderPath);

echo "\n\n";
echo "19. Delete Folder: \n";
echo "\033[01;32m".print_r($deleteFolder,true)."\033[0m";
echo "\n";

// Bulk Job Status

$bulkJobStatus = $imageKit->getBulkJobStatus($job_id);

echo "\n\n";
echo "20. Bulk Job Status: \n";
echo "\033[01;32m".print_r($bulkJobStatus,true)."\033[0m";
echo "\n";

// Purge Cache

$image_url = $url_end_point.'/sample-folder/default-image.jpg';
$purgeCache = $imageKit->purgeCache($image_url);
$cacheRequestId = $purgeCache->result->requestId;
echo "\n\n";
echo "21. Purge Cache: \n";
echo "\033[01;32m".print_r($purgeCache,true)."\033[0m";
echo "\n";

// Purge Cache Status

$getPurgeCacheStatus = $imageKit->getPurgeCacheStatus($cacheRequestId);

echo "\n\n";
echo "22. Purge Cache Status: \n";
echo "\033[01;32m".print_r($getPurgeCacheStatus,true)."\033[0m";
echo "\n";

// Get File Metadata (From File ID)

$getFileMetadata = $imageKit->getFileMetaData($file_id);

echo "\n\n";
echo "23. Get File Metadata (From File ID): \n";
echo "\033[01;32m".print_r($getFileMetadata,true)."\033[0m";
echo "\n";

// Get File Metadata (From Remote URL)

$getFileMetadata = $imageKit->getFileMetadataFromRemoteURL($image_url);

echo "\n\n";
echo "24. Get File Metadata (From Remote URL): \n";
echo "\033[01;32m".print_r($getFileMetadata,true)."\033[0m";
echo "\n";

// Delete File Version

$deleteFileVersion = $imageKit->deleteFileVersion($file_id, $version_id);

echo "\n\n";
echo "25. Delete File Version: \n";
echo "\033[01;32m".print_r($deleteFileVersion,true)."\033[0m";
echo "\n";

// Delete File

$deleteFile = $imageKit->deleteFile($file_id);

echo "\n\n";
echo "26. Delete File: \n";
echo "\033[01;32m".print_r($deleteFile,true)."\033[0m";
echo "\n";

// Delete Files (Bulk)

$fileIds = [$file_id];
$deleteFiles = $imageKit->bulkDeleteFiles($fileIds);

echo "\n\n";
echo "27. Delete Files (Bulk): \n";
echo "\033[01;32m".print_r($deleteFiles,true)."\033[0m";
echo "\n";
