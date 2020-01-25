<?php

define ("INVALID_LIST_FILES_OPTIONS", serialize (array( "message" => "Invalid List Files Options ImageKit initialization", "help" => "" )));
define ("INVALID_UPLOAD_OPTIONS", serialize (array( "message" => "Invalid Upload Options ImageKit initialization", "help" => "" )));
define ("MANDATORY_INITIALIZATION_MISSING", serialize (array( "message" => "Missing publicKey or privateKey or urlEndpoint during ImageKit initialization", "help" => "" )));
define("INVALID_TRANSFORMATION_POSITION" , serialize(array( "message" => "Invalid transformationPosition parameter", "help" => "" )));
define("INVALID_FILE_OPTIONS" , serialize(array( "message" => "Invalid File Optios ImageKit initialization", "help" => "" )));
define("CACHE_PURGE_URL_MISSING" , serialize(array("message" => "Missing URL parameter for this request", "help" => "" )));
define("CACHE_PURGE_STATUS_ID_MISSING" , serialize(array ("message" => "Missing Request ID parameter for this request", "help" => "")));
define("FILE_ID_MISSING" , serialize(array("message" => "Missing File ID parameter for this request", "help" => "")));
define("UPDATE_DATA_MISSING" , serialize(array("message" => "Missing file update data for this request", "help" => "")));
define("UPDATE_DATA_TAGS_INVALID" , serialize(array("message" => "Invalid tags parameter for this request", "help" => "tags should be passed as null or an array like ['tag1', 'tag2']")));
define("UPDATE_DATA_COORDS_INVALID" , serialize(array("message" => "Invalid customCoordinates parameter for this request", "help" => "customCoordinates should be passed as null or a string like 'x,y,width,height'")));
define("LIST_FILES_INPUT_MISSING" , serialize(array("message" => "Missing options for list files", "help" => "If you do not want to pass any parameter for listing, pass an empty object")));
define("MISSING_UPLOAD_DATA" , serialize(array("message" => "Missing data for upload", "help" => "")));
define("MISSING_UPLOAD_FILE_PARAMETER" , serialize(array("message" => "Missing file parameter for upload", "help" => "")));
define("MISSING_UPLOAD_FILENAME_PARAMETER" , serialize(array("message" => "Missing fileName parameter for upload", "help" => "")));
// pHash errors
define("INVALID_PHASH_VALUE", serialize(array("message"=> "Invalid pHash value", "help"=> "Both pHash strings must be valid hexadecimal numbers")));
define("MISSING_PHASH_VALUE", serialize(array("message"=> "Missing pHash value", "help"=> "Please pass two pHash values")));
define("UNEQUAL_STRING_LENGTH", serialize(array("message"=> "Unequal pHash string length", "help"=> "For distance calucation, the two pHash strings must have equal length")));
define("FILE_IDS_MISSING", serialize(array("message"=> "FileIds parameter is missing.","help"=> "For support kindly contact us at support@imagekit.io .")));
define("MISSING_URL_PARAMETER", serialize(array("message"=> "Your request is missing the url query paramater.","help"=> "For support kindly contact us at support@imagekit.io .")));
