<?php

namespace ImageKit\Tests\ImageKit\Manage;


use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use ImageKit\ImageKit;
use ImageKit\Resource\GuzzleHttpWrapper;
use PHPUnit\Framework\TestCase;

/**
 *
 */
final class FileTest extends TestCase
{
    /**
     * @var ImageKit
     */
    private $client;

        /**
     *
     */
    public function testListFiles()
    {
        $responseBody = [
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
            ],
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->listFiles();

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    /**
     *
     */
    public function testListFilesWithOptions()
    {
        $listOptions = [
            'skip' => 0,
            'limit' => 100,
        ];

        $responseBody = [
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
            ],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->listFiles($listOptions);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
      
    /**
     *
     */
    public function testListFilesWithInvalidOptions()
    {
        $listOptions = 'invalid';

        $response = $this->client->listFiles($listOptions);

        FileTest::assertEquals('List File Options accepts an array of parameters, non array value passed', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileDetails()
    {
        $fileId = '23902390239203923';
       
        $responseBody = [
            'type' => 'file',
            'name' => 'default-image.jpg',
            'fileId' => '5de4fb65c851e55df73abe8d',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
            'fileType' => 'image',
            'filePath' => '/default-image.jpg',
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileDetails($fileId);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     *
     */
    public function testGetFileDetailsWithMissingFileId()
    {
        $fileId = '';
       
        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileDetails($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testGetFileVersionDetails()
    {
        $fileId = '23902390239203923';
        $versionId = '23902390239203923';
       
        $responseBody = [
            'type' => 'file',
            'name' => 'default-image.jpg',
            'fileId' => '5de4fb65c851e55df73abe8d',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
            'fileType' => 'image',
            'filePath' => '/default-image.jpg',
            "versionInfo" => [
                "id" => "598821f949c0a938d57563bd",
                "name" => "Version 1"
            ],
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileVersionDetails($fileId, $versionId);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     *
     */
    public function testGetFileVersionDetailsWithMissingFileId()
    {
        $fileId = '';
        $versionId = '23902390239203923';
       
        $response = $this->client->getFileVersionDetails($fileId, $versionId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileVersionDetailsWithMissingVersionId()
    {
        $fileId = '23902390239203923';
        $versionId = '';
       
        $response = $this->client->getFileVersionDetails($fileId, $versionId);

        FileTest::assertEquals('Missing Version ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileVersions()
    {
        $fileId = '23902390239203923';
       
        $responseBody = [
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
                "versionInfo" => [
                    "id" => "598821f949c0a938d57563bd",
                    "name" => "Version 1"
                ]
            ],
            [
                'type' => 'file',
                'name' => 'default-image.jpg',
                'fileId' => '5de4fb65c851e55df73abe8d',
                'tags' => null,
                'customCoordinates' => null,
                'isPrivateFile' => false,
                'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
                'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
                'fileType' => 'image',
                'filePath' => '/default-image.jpg',
                "versionInfo" => [
                    "id" => "330a81i1f949c0a938d57563bd",
                    "name" => "Version 2"
                ]
            ],
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileVersions($fileId);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    
    /**
     *
     */
    public function testGetFileVersionsWithMissingFileId()
    {
        $fileId = '';
       
        $response = $this->client->getFileVersions($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    
    /**
     *
     */
    public function testUpdateFileDetails()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $responseBody = [
            'fileId' => '598821f949c0a938d57563bd',
            'type' => 'file',
            'name' => 'file1.jpg',
            'filePath' => '/images/products/file1.jpg',
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
            'isPrivateFile' => false,
            'customCoordinates' => null,
            'url' => 'https://ik.imagekit.io/your_imagekit_id/images/products/file1.jpg',
            'thumbnail' => 'https://ik.imagekit.io/your_imagekit_id/tr:n-media_library_thumbnail/images/products/file1.jpg',
            'fileType' => 'image'
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('patch', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->error);
        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     *
     */
    public function testUpdateFileDetailsWithMissingFileId()
    {
        $fileId = '';

        $updateData = [
            'customCoordinates' => '10,10,100,100',
            'tags' => ['tag1', 'tag2']
        ];

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    
    /**
     *
     */
    public function testUpdateFileDetailsWithInvalidUpdateData()
    {
        $fileId = '5df36759adf3f523d81dd94f';

        $updateData = [];

        $response = $this->client->updateFileDetails($fileId, $updateData);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing file update data for this request', $response->error->message);
    }

    /**
     *
     */
    public function testBulkAddTags()
    {
        $fileIds = ['5e21880d5efe355febd4bccd','5e1c13c1c55ec3437c451403'];
        $tags = ['testing_tag1'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
        ];

        $mockBodyResponse = Utils::streamfor(json_encode($responseBody));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    
    /**
     *
     */
    public function testBulkAddTagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    

    /**
     *
     */
    public function testBulkAddTagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }

     /**
     *
     */
    public function testBulkAddTagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkAddTagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkAddTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testBulkRemoveTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = ['testing_tag1'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "23902390239203923",
            ]
        ];

        $mockBodyResponse = Utils::streamfor(json_encode($responseBody));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }
        
     
    /**
     *
     */
    public function testBulkRemoveTagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveTagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkRemoveTags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testBulkRemoveAITags()
    {
        $fileIds = ['5e21880d5efe355febd4bccd','5e1c13c1c55ec3437c451403'];
        $tags = ['image_AITag_1','image_AITag_2'];

        $responseBody = [
            "successfullyUpdatedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
        ];

        $mockBodyResponse = Utils::streamfor(json_encode($responseBody));

        $this->stubHttpClient('post', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsMissingFileIds()
    {
        $fileIds = [];
        $tags = ['image_AITag_1'];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array of ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsMissingTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = [];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array of tags, empty array passed', $response->error->message);
    }
        
     
    /**
     *
     */
    public function testBulkRemoveAITagsNonArrayFileId()
    {
        $fileIds = '23902390239203923';
        $tags = ['testing_tag1'];

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts FileIds as an array, non array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkRemoveAITagsNonArrayTags()
    {
        $fileIds = ['23902390239203923'];
        $tags = 'testing_tag1';

        $response = $this->client->bulkRemoveAITags($fileIds, $tags);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Bulk Tags API accepts Tags as an array, non array passed', $response->error->message);
    }

    /**
     *
     */
    public function testDeleteSingleFile()
    {
        $fileId = "23902390239203923";
        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('delete',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteFile($fileId);

        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
    }
    
    /**
     *
     */
    public function testDeleteSingleFileMissingFileId()
    {
        $fileId = "";

        $response = $this->client->deleteFile($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testDeleteFileVersion()
    {
        $fileId = 'file_id';
        $versionId = "version_id";
        
        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('delete',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->deleteFileVersion($fileId, $versionId);

        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
    }
    
    /**
     *
     */
    public function testDeleteFileVersionWithMissingFileId()
    {
        $fileId = "";
        $versionId = "version_id";

        $response = $this->client->deleteFileVersion($fileId, $versionId);

        FileTest::assertEquals('Missing File ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testDeleteFileVersionWithMissingVisionId()
    {
        $fileId = "file_id";
        $versionId = "";

        $response = $this->client->deleteFileVersion($fileId, $versionId);

        FileTest::assertEquals('Missing Version ID parameter for this request',$response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFiles()
    {
        $fileIds = ['file_id1','file_id2'];
        
        $responseBody = [
            "successfullyDeletedFileIds" => [
                "5e21880d5efe355febd4bccd",
                "5e1c13c1c55ec3437c451403"
            ]
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('post',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

    /**
     *
     */
    public function testBulkDeleteFilesInvalidRequest()
    {   
        $response = $this->client->bulkDeleteFiles();

        FileTest::assertEquals('Missing Parameter FileIds', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFilesMissingFileIds()
    {   
        $fileIds = [];
        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertEquals('File ids should be passed as an array of file ids, empty array passed', $response->error->message);
    }
    
    /**
     *
     */
    public function testBulkDeleteFilesNonArrayFileIds()
    {   
        $fileIds = 'file_id';
        $response = $this->client->bulkDeleteFiles($fileIds);

        FileTest::assertEquals('File ids should be passed in an array', $response->error->message);
    }
    
    /**
     *
     */
    public function testCopyFile()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->copyFile($requestBody);

        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
    }
    
    /**
     *
     */
    public function testCopyFileInvalidParameter()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [];

        $response = $this->client->copyFile($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Copy File API accepts an array of parameters, empty array passed',$response->error->message);

    }
    

    /**
     *
     */
    public function testCopyFileMissingSourceFilePath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [
            'destinationPath' => $destinationPath,
            'includeVersions' => $includeVersions
        ];

        $response = $this->client->copyFile($requestBody);

        
        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath and/or includeVersions for Copy File API',$response->error->message);

    }
    
    /**
     *
     */
    public function testCopyFileMissingDestinationPath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = true;

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'includeVersions' => $includeVersions
        ];

        $response = $this->client->copyFile($requestBody);

        
        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath and/or includeVersions for Copy File API',$response->error->message);

    }
    
    
    /**
     *
     */
    public function testCopyFileNullIncludeVersions()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';
        $includeVersions = null;


        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath,
            'includeVersions'   => $includeVersions
        ];

        $response = $this->client->copyFile($requestBody);

        
        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath and/or includeVersions for Copy File API',$response->error->message);

    }
    
    /**
     *
     */
    public function testMoveFile()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
            'destinationPath' => $destinationPath
        ];

        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('post',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->moveFile($requestBody);
        
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
    }
    
    /**
     *
     */
    public function testMoveFileInvalidParameter()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [];

        $response = $this->client->moveFile($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Move File API accepts an array of parameters, empty array passed',$response->error->message);
    }

    /**
     *
     */
    public function testMoveFileMissingSourceFilePath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'destinationPath' => $destinationPath,
        ];

        $response = $this->client->moveFile($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Move File API',$response->error->message);
    }

    /**
     *
     */
    public function testMoveFileMissingDestinationPath()
    {
        $sourceFilePath = '/file.jpg';
        $destinationPath = '/';

        $requestBody = [
            'sourceFilePath' => $sourceFilePath,
        ];

        $response = $this->client->moveFile($requestBody);

        FileTest::assertNull($response->result);
        FileTest::assertEquals('Missing parameter sourceFilePath and/or destinationPath for Move File API',$response->error->message);

    }

     /**
     *
     */
    public function testRenameFile()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = 'sample-file2.jpg';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
        ];
        $mockBodyResponse = Utils::streamFor();

        $this->stubHttpClient('put',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->renameFile($requestBody);
        
        FolderTest::assertNull($response->result);
        FolderTest::assertNull($response->error);
    }

     /**
     *
     */
    public function testRenameFileWithInvalidRequest()
    {
        $response = $this->client->renameFile();

        FileTest::assertEquals('Rename File API accepts an array, null passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithNonArrayParameter()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = 'sample-file2.jpg';

        $requestBody = $filePath;

        $response = $this->client->renameFile($requestBody);

        FileTest::assertEquals('Rename File API accepts an array of parameters, non array value passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithEmptyArrayParameter()
    {
        $requestBody = [];

        $response = $this->client->renameFile($requestBody);

        FileTest::assertEquals('Rename File API accepts an array of parameters, empty array passed',$response->error->message);
    }

     /**
     *
     */
    public function testRenameFileWithMissingFilePath()
    {
        $filePath = '';
        $newFileName = 'sample-file2.jpg';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
        ];

        $response = $this->client->renameFile($requestBody);

        FileTest::assertEquals('Missing parameter filePath and/or newFileName for Rename File API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRenameFileWithMissingNewFileName()
    {
        $filePath = '/sample-folder/sample-file.jpg';
        $newFileName = '';

        $requestBody = [
            'filePath' => $filePath,
            'newFileName' => $newFileName,
        ];

        $response = $this->client->renameFile($requestBody);

        FileTest::assertEquals('Missing parameter filePath and/or newFileName for Rename File API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersion()
    {
        $fileId = 'fileId';
        $versionId = 'versionId';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $responseBody = [
            'type' => 'file',
            'name' => 'default-image.jpg',
            'fileId' => '5de4fb65c851e55df73abe8d',
            'tags' => null,
            'customCoordinates' => null,
            'isPrivateFile' => false,
            'url' => 'https://ik.imagekit.io/ot2cky3ujwa/default-image.jpg',
            'thumbnail' => 'https://ik.imagekit.io/ot2cky3ujwa/tr:n-media_library_thumbnail/default-image.jpg',
            'fileType' => 'image',
            'filePath' => '/default-image.jpg',
            "versionInfo" => [
                "id" => "598821f949c0a938d57563bd",
                "name" => "Version 1"
            ],
        ];

        $mockBodyResponse = Utils::streamFor(json_encode($responseBody));

        $this->stubHttpClient('put',new Response(200,['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals(json_encode($responseBody), json_encode($response->result));
    }

     /**
     *
     */
    public function testRestoreFileVersionWithInvalidRequest()
    {
        $response = $this->client->restoreFileVersion();

        FileTest::assertEquals('Restore File Version API accepts an array, null passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithNonArrayParameter()
    {
        $fileId = 'fileId';
        $versionId = 'versionId';

        $requestBody = $fileId;

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Restore File Version API accepts an array of parameters, non array value passed',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithEmptyArrayParameter()
    {
        $requestBody = [];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Restore File Version API accepts an array of parameters, empty array passed',$response->error->message);
    }

     /**
     *
     */
    public function testRestoreFileVersionWithMissingFileId()
    {
        $fileId = '';
        $versionId = 'versionId';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Missing parameter fileId and/or versionId for Restore File Version API',$response->error->message);
    }
    
     /**
     *
     */
    public function testRestoreFileVersionWithMissingVersionId()
    {
        $fileId = 'fileId';
        $versionId = '';

        $requestBody = [
            'fileId' => $fileId,
            'versionId' => $versionId,
        ];

        $response = $this->client->restoreFileVersion($requestBody);

        FileTest::assertEquals('Missing parameter fileId and/or versionId for Restore File Version API',$response->error->message);
    }
    

    
    /**
     *
     */
    public function testGetFileMetadataUsingFileId()
    {
        $fileId = '5de4fb65c851e55df73abe8d';
        
        $requestBody = [
            'height' => 3214,
            'width' => 3948,
            'size' => 207097,
            'format' => 'jpg',
            'hasColorProfile' => true,
            'quality' => 90,
            'density' => 300,
            'hasTransparency' => false,
            'exif' => [
                'image' => [
                    'ImageWidth' => 4584,
                    'ImageHeight' => 3334,
                    'BitsPerSample' => [8, 8, 8],
                    'PhotometricInterpretation' => 2,
                    'ImageDescription' => 'Character illustration of people holding creative ideas icons',
                    'Orientation' => 1,
                    'SamplesPerPixel' => 3,
                    'XResolution' => 300,
                    'YResolution' => 300,
                    'ResolutionUnit' => 2,
                    'Software' => 'Adobe Photoshop CC 2019 (Windows)',
                    'ModifyDate' => '2019=>05=>25 10=>16=>49',
                    'Artist' => 'busbus',
                    'Copyright' => 'Rawpixel Ltd.',
                    'ExifOffset' => 356
                ],
                'thumbnail' => [
                    'Compression' => 6,
                    'XResolution' => 72,
                    'YResolution' => 72,
                    'ResolutionUnit' => 2,
                    'ThumbnailOffset' => 506,
                    'ThumbnailLength' => 6230,
                ],
                'exif' => [
                    'ExifVersion' => '0221',
                    'ColorSpace' => 65535,
                    'ExifImageWidth' => 3948,
                    'ExifImageHeight' => 3214
                ],
                'gps' => [],
                'interoperability' => [],
                'makernote' => [],
            ],
            'pHash' => 'd1813e2fc22c7b2f',
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($requestBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetaData($fileId);

        FileTest::assertEquals(json_encode($requestBody), json_encode($response->result));
    }

    
    /**
     *
     */
    public function testGetFileMetadataUsingFileIdWithMissingFileId()
    {
        $fileId = '';
        
        $response = $this->client->getFileMetaData($fileId);

        FileTest::assertEquals('Missing File ID parameter for this request', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURL()
    {
        $remoteURL = 'https://ik.imagekit.io/demo/sample-folder/default-image.jpg';
        
        $requestBody = [
            'height' => 3214,
            'width' => 3948,
            'size' => 207097,
            'format' => 'jpg',
            'hasColorProfile' => true,
            'quality' => 90,
            'density' => 300,
            'hasTransparency' => false,
            'exif' => [
                'image' => [
                    'ImageWidth' => 4584,
                    'ImageHeight' => 3334,
                    'BitsPerSample' => [8, 8, 8],
                    'PhotometricInterpretation' => 2,
                    'ImageDescription' => 'Character illustration of people holding creative ideas icons',
                    'Orientation' => 1,
                    'SamplesPerPixel' => 3,
                    'XResolution' => 300,
                    'YResolution' => 300,
                    'ResolutionUnit' => 2,
                    'Software' => 'Adobe Photoshop CC 2019 (Windows)',
                    'ModifyDate' => '2019=>05=>25 10=>16=>49',
                    'Artist' => 'busbus',
                    'Copyright' => 'Rawpixel Ltd.',
                    'ExifOffset' => 356
                ],
                'thumbnail' => [
                    'Compression' => 6,
                    'XResolution' => 72,
                    'YResolution' => 72,
                    'ResolutionUnit' => 2,
                    'ThumbnailOffset' => 506,
                    'ThumbnailLength' => 6230,
                ],
                'exif' => [
                    'ExifVersion' => '0221',
                    'ColorSpace' => 65535,
                    'ExifImageWidth' => 3948,
                    'ExifImageHeight' => 3214
                ],
                'gps' => [],
                'interoperability' => [],
                'makernote' => [],
            ],
            'pHash' => 'd1813e2fc22c7b2f',
        ];
        $mockBodyResponse = Utils::streamFor(json_encode($requestBody));

        $this->stubHttpClient('get', new Response(200, ['X-Foo' => 'Bar'], $mockBodyResponse));

        $response = $this->client->getFileMetadataFromRemoteURL($remoteURL);

        FileTest::assertEquals(json_encode($requestBody), json_encode($response->result));
    }



    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURLMissingURL()
    {
        $remoteURL = '';
        
        $response = $this->client->getFileMetadataFromRemoteURL($remoteURL);

        FileTest::assertEquals('Your request is missing the url query paramater', $response->error->message);
    }

    /**
     *
     */
    public function testGetFileMetadataUsingRemoteURLInvalidURL()
    {
        $remoteURL = 'invalid_url';
        
        $response = $this->client->getFileMetadataFromRemoteURL($remoteURL);

        FileTest::assertEquals('Invalid URL provided for this request', $response->error->message);
    }
    
    /**
     *
     */
    private function stubHttpClient($methodName, $response)
    {
        $stub = $this->createMock(GuzzleHttpWrapper::class);
        $stub->method('setDatas');
        $stub->method($methodName)->willReturn($response);

        $closure = function () use ($stub) {
            $this->httpClient = $stub;
        };
        $doClosure = $closure->bindTo($this->client, ImageKit::class);
        $doClosure();
    }

    protected function setUp(): void
    {
        $this->client = new ImageKit(
            'testing_public_key',
            'testing_private_key',
            'https://ik.imagekit.io/demo'
        );

    }

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
