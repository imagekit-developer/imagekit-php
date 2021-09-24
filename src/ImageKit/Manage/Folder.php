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
        if (empty($folderName) || empty($parentFolderPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_CREATE_FOLDER_OPTIONS));
        }

        $httpClient->setDatas(['parentFolderPath' => $parentFolderPath, 'folderName' => $folderName]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        $res = $httpClient->delete();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function copy($sourceFolderPath, $destinationPath, GuzzleHttpWrapper $httpClient)
    {
        if (empty($sourceFolderPath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_COPY_FOLDER_OPTIONS));
        }

        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
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
        if (empty($sourceFolderPath) || empty($destinationPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_MOVE_FOLDER_OPTIONS));
        }

        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }
}
