<?php

namespace ImageKit\Constants;


/**
 *
 */
class ErrorMessages
{
    public static $INVALID_REQUEST = ['message' => 'Invalid Request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_UPLOAD_OPTIONS = ['message' => 'Invalid Upload Options ImageKit initialization', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_LIST_FILES_OPTIONS = ['message' => 'Invalid List Files Options ImageKit initialization', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MANDATORY_INITIALIZATION_MISSING = ['message' => 'Missing publicKey or privateKey or urlEndpoint during ImageKit initialization', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_TRANSFORMATION_POSITION = ['message' => 'Invalid transformationPosition parameter', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_FILE_OPTIONS = ['message' => 'Invalid File Options ImageKit initialization', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $LIST_FILES_OPTIONS_NON_ARRAY = ['message' => 'List File Options accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CACHE_PURGE_URL_MISSING = ['message' => 'Missing URL parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CACHE_PURGE_URL_INVALID = ['message' => 'Invalid URL provided for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CACHE_PURGE_STATUS_ID_MISSING = ['message' => 'Missing Request ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $fileId_MISSING = ['message' => 'Missing File ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $versionId_MISSING = ['message' => 'Missing Version ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $JOBID_MISSING = ['message' => 'Missing Job ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_DATA_MISSING = ['message' => 'Missing file update data for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $BULK_TAGS_DATA_MISSING = ['message' => 'Missing bulk tag update data for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $BULK_TAGS_FILEIDS_MISSING = ['message' => 'Missing FileIds for Bulk Tags API', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $BULK_TAGS_FILEIDS_NON_ARRAY = ['message' => 'Bulk Tags API accepts FileIds as an array, non array passed', 'help' => 'For support kindly contact us at support@imagekit.io .' ];
    public static $BULK_TAGS_FILEIDS_EMPTY_ARRAY = ['message' => 'Bulk Tags API accepts FileIds as an array of ids, empty array passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $BULK_TAGS_TAGS_MISSING = ['message' => 'Missing Tags for Bulk Tags API', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $BULK_TAGS_TAGS_NON_ARRAY = ['message' => 'Bulk Tags API accepts Tags as an array, non array passed', 'help' => 'For support kindly contact us at support@imagekit.io .' ];
    public static $BULK_TAGS_TAGS_EMPTY_ARRAY = ['message' => 'Bulk Tags API accepts Tags as an array of tags, empty array passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_DATA_TAGS_INVALID = ['message' => 'Invalid tags parameter for this request', 'help' => "tags should be passed as null or an array like ['tag1', 'tag2']"];
    public static $UPDATE_DATA_COORDS_INVALID = ['message' => 'Invalid customCoordinates parameter for this request', 'help' => "customCoordinates should be passed as null or a string like 'x,y,width,height'"];
    public static $LIST_FILES_INPUT_MISSING = ['message' => 'Missing options for list files', 'help' => 'if you do not want to pass any parameter for listing, pass an empty object'];
    public static $UPLOAD_FILE_PARAMETER_MISSING = ['message' => 'Upload API accepts an array of parameters, null passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_NON_ARRAY = ['message' => 'Upload API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_EMPTY_ARRAY = ['message' => 'Upload API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_NON_ARRAY = ['message' => 'Upload API parameter "options" accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_USEUNIQUEFILENAME_INVALID = ['message' => 'useUniqueFileName must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_ISPRIVATEFILE_INVALID = ['message' => 'isPrivateFile must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITEFILE_INVALID = ['message' => 'overwriteFile must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITEAITAGS_INVALID = ['message' => 'overwriteAITags must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITETAGS_INVALID = ['message' => 'overwriteTags must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_OVERWRITECUSTOMMETADATA_INVALID = ['message' => 'overwriteCustomMetadata must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_EXTENSIONS_INVALID = ['message' => 'extensions must be an array', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_CUSTOMMETADATA_INVALID = ['message' => 'customMetadata must be an array', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_INVALID_TRANSFORMATION  = [ "message" => "Invalid transformation parameter. Please include at least pre, post, or both.", "help" => "For support kindly contact us at support@imagekit.io ."];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_INVALID_PRE_TRANSFORMATION = [ "message" => "Invalid pre transformation parameter.", "help" => "For support kindly contact us at support@imagekit.io ."];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_INVALID_POST_TRANSFORMATION = [ "message" => "Invalid post transformation parameter.", "help" => "For support kindly contact us at support@imagekit.io ."];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_INVALID_CHECKS = [ "message" => "The value provided for the checks parameter is invalid.", "help" => "For support kindly contact us at support@imagekit.io ."];
    public static $UPLOAD_FILE_PARAMETER_OPTIONS_INVALID_PUBLISH_STATUS = [ "message" => "isPublished must be boolean.", "help" => "For support kindly contact us at support@imagekit.io ."];
    public static $MISSING_UPLOAD_DATA = ['message' => 'Missing data for upload', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_UPLOAD_FILE_PARAMETER = ['message' => 'Missing file parameter for upload', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_UPLOAD_FILENAME_PARAMETER = ['message' => 'Missing fileName parameter for upload', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_PHASH_VALUE = ['message' => 'Invalid pHash value', 'help' => 'Both pHash strings must be valid hexadecimal numbers'];
    public static $MISSING_PHASH_VALUE = ['message' => 'Missing pHash value', 'help' => 'Both pHash strings must be valid hexadecimal numbers'];
    public static $UNEQUAL_STRING_LENGTH = ['message' => 'Unequal pHash string length', 'help' => 'For distance calucation, the two pHash strings must have equal length'];
    public static $fileIdS_MISSING = ['message' => 'Missing Parameter FileIds', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $fileIdS_NON_ARRAY = ['message' => 'File ids should be passed in an array', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $fileIdS_EMPTY_ARRAY = ['message' => 'File ids should be passed as an array of file ids, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_URL_PARAMETER = ['message' => 'Your request is missing the url query paramater', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $INVALID_URL_PARAMETER = ['message' => 'Invalid URL provided for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_PARAMETER_MISSING = ['message' => 'URL Generation Method accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_PARAMETER_NON_ARRAY = ['message' => 'URL Generation API accepts an array of parameters, non array value passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_PARAMETER_EMPTY_ARRAY = ['message' => 'URL Generation API accepts an array of parameters, empty array passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_SRC_INVALID = ['message' => 'src is not a valid URL', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_URL_INVALID = ['message' => 'Invalid urlEndpoint value', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_TRANSFORMATION_PARAMETER_INVALID = ['message' => 'Transformation Parameter accepts an array, not array or null provided.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_CONDITION_MISSING = ['message' => 'Missing Parameter "condition" in if statement.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_CONDITION_NON_ARRAY = ['message' => 'Invalid Parameter. "condition" accepts an array of parameters, non array value passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_CONDITION_EMPTY_ARRAY = ['message' => '"condition" accepts an array of parameters, empty array passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_CONDITION_INVALID_PROPERTY = ['message' => 'Invalid property applied in the condition. Refer to SDK docs for allowed properties.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_CONDITION_INVALID_OPERAND = ['message' => 'Invalid operator applied. Allowed operators are "==","!=",">",">=","<","<="', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_TRUE_MISSING = ['message' => 'Missing Parameter "true" in if statement.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_TRUE_NON_ARRAY = ['message' => 'Invalid Parameter. "true" accepts an array of parameters, non array value passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_IF_TRUE_EMPTY_ARRAY = ['message' => '"true" accepts an array of parameters, empty array passed.', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_TRANSFORMATION_QUERY_INVALID = ['message' => 'Invalid value provided for "transformationPosition". Supported values are "path" and "query"', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FILE_PARAMETER_MISSING = ['message' => 'Copy File API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FILE_PARAMETER_NON_ARRAY = ['message' => 'Copy File API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FILE_PARAMETER_EMPTY_ARRAY = ['message' => 'Copy File API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FILE_DATA_INVALID = ['message' => 'Missing parameter sourceFilePath and/or destinationPath for Copy File API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FILE_PARAMETER_MISSING = ['message' => 'Move File API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FILE_PARAMETER_NON_ARRAY = ['message' => 'Move File API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FILE_PARAMETER_EMPTY_ARRAY = ['message' => 'Move File API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FILE_DATA_INVALID = ['message' => 'Missing parameter sourceFilePath and/or destinationPath for Move File API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $RENAME_FILE_PARAMETER_MISSING = ['message' => 'Rename File API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $RENAME_FILE_PARAMETER_NON_ARRAY = ['message' => 'Rename File API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RENAME_FILE_PARAMETER_EMPTY_ARRAY = ['message' => 'Rename File API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RENAME_FILE_DATA_INVALID = ['message' => 'Missing parameter filePath and/or newFileName for Rename File API', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RENAME_FILE_DATA_INVALID_PURGE_CACHE = ['message' => 'purgeCache parameter must be boolean', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RESTORE_FILE_VERSION_PARAMETER_MISSING = ['message' => 'Restore File Version API accepts an array, null passed', 'help' =>
    'For support kindly contact us at support@imagekit.io .'];
    public static $RESTORE_FILE_VERSION_PARAMETER_NON_ARRAY = ['message' => 'Restore File Version API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RESTORE_FILE_VERSION_PARAMETER_EMPTY_ARRAY = ['message' => 'Restore File Version API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $RESTORE_FILE_VERSION_DATA_INVALID = ['message' => 'Missing parameter fileId and/or versionId for Restore File Version API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_FOLDER_PARAMETER_MISSING = ['message' => 'Create Folder API accepts an array, null passed', 'help' =>
    'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_FOLDER_PARAMETER_NON_ARRAY = ['message' => 'Create Folder API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_FOLDER_PARAMETER_EMPTY_ARRAY = ['message' => 'Create Folder API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_FOLDER_DATA_INVALID = ['message' => 'Missing parameter folderName and/or parentFolderPath for Create Folder API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $DELETE_FOLDER_PARAMETER_MISSING = ['message' => 'Missing folderPath for Delete Folder API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FOLDER_PARAMETER_MISSING = ['message' => 'Copy Folder API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FOLDER_PARAMETER_NON_ARRAY = ['message' => 'Copy Folder API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FOLDER_PARAMETER_EMPTY_ARRAY = ['message' => 'Copy Folder API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $COPY_FOLDER_DATA_INVALID = ['message' => 'Missing parameter sourceFolderPath and/or destinationPath for Copy Folder API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FOLDER_PARAMETER_MISSING = ['message' => 'Move Folder API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FOLDER_PARAMETER_NON_ARRAY = ['message' => 'Move Folder API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FOLDER_PARAMETER_EMPTY_ARRAY = ['message' => 'Move Folder API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MOVE_FOLDER_DATA_INVALID = ['message' => 'Missing parameter sourceFolderPath and/or destinationPath for Move Folder API', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_CREATE_FOLDER_OPTIONS = ['message' => 'Missing data for creation of folder', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_DELETE_FOLDER_OPTIONS = ['message' => 'Missing data for deletion of folder', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_COPY_FOLDER_OPTIONS = ['message' => 'Missing data for copying folder', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $MISSING_MOVE_FOLDER_OPTIONS = ['message' => 'Missing data for moving folder', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_CUSTOM_METADATA_PARAMETER_MISSING = ['message' => 'Create Custom Metadata API accepts an array, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_CUSTOM_METADATA_PARAMETER_NON_ARRAY = ['message' => 'Create Custom Metadata API accepts an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_CUSTOM_METADATA_PARAMETER_EMPTY_ARRAY = ['message' => 'Create Custom Metadata API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_CUSTOM_METADATA_DATA_INVALID = ['message' => 'Missing parameter name and/or label and/or schema for this request', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $CREATE_CUSTOM_METADATA_DATA_INVALID_SCHEMA_OBJECT = ['message' => 'Invalid parameter schema', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $GET_CUSTOM_METADATA_INVALID_PARAMETER = ['message' => 'Invalid parameter includeDeleted', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_PARAMETER_MISSING = ['message' => 'Update Custom Metadata API accepts an id and requestBody, null passed', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_PARAMETER_NON_ARRAY = ['message' => 'Update Custom Metadata API accepts requestBody as an array of parameters, non array value passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_PARAMETER_EMPTY_ARRAY = ['message' => 'Update Custom Metadata API accepts an array of parameters, empty array passed', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_DATA_INVALID = ['message' => 'Missing parameter label and/or schema for this request', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_DATA_INVALID_SCHEMA_OBJECT = ['message' => 'Invalid parameter schema', 'help' =>
        'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_ID_MISSING = ['message' => 'Missing Custom Metadata Field ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $UPDATE_CUSTOM_METADATA_BODY_MISSING = ['message' => 'Missing body parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $DELETE_CUSTOM_METADATA_ID_MISSING = ['message' => 'Missing Custom Metadata Field ID parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $PHASH_DISTANCE_FIRST_PHASH_MISSING = ['message' => 'Missing First pHash parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $PHASH_DISTANCE_SECOND_PHASH_MISSING = ['message' => 'Missing Second pHash parameter for this request', 'help' => 'For support kindly contact us at support@imagekit.io .'];
    public static $URL_GENERATION_EXPIRESECONDS_PARAMETER_INVALID = ['message' => 'expireSeconds accepts an integer value, non integer value provided.', 'help' => 'For support kindly contact us at support@imagekit.io .'];       
}
