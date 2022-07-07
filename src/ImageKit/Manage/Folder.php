<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Folder
{
    /**
     * @param $folderName
     * @param $parentFolderPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function create($folderName, $parentFolderPath, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['parentFolderPath' => $parentFolderPath, 'folderName' => $folderName]);
        try {
            $res = $httpClient->post();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = $res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }

    /**
     * @param $folderPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function delete($folderPath, GuzzleHttpWrapper $httpClient)
    {
        if (empty($folderPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_DELETE_FOLDER_OPTIONS));
        }

        $httpClient->setDatas(['folderPath' => $folderPath]);
        try {
            $res = $httpClient->delete();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = $res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     * @param $includeVersions
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function copy($sourceFolderPath, $destinationPath, $includeFileVersions, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath, 'includeFileVersions' => $includeFileVersions]);
        try {
            $res = $httpClient->post();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = $res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function move($sourceFolderPath, $destinationPath, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath]);
        try {
            $res = $httpClient->post();
        } catch (\Throwable $th) {
            return Response::respond(true, $th->getMessage());
        }
        if($res && $res->getBody() && $res->getHeaders() && $res->getStatusCode()){
            $stream = $res->getBody();
            $content = [];
            $content['body'] = json_decode($stream->getContents());
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
            $content['statusCode'] = $res->getStatusCode();
    
            if ($res->getStatusCode() && ($res->getStatusCode() < 200 || $res->getStatusCode() > 300)) {
                return Response::respond(true, ($content));
            }
    
            return Response::respond(false, ($content));
        }
        else{
            return Response::respond(true, ((object)ErrorMessages::$INVALID_REQUEST)->message);
        }
    }
}
