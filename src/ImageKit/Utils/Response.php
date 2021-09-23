<?php

namespace ImageKit\Utils;

/**
 *
 */
class Response
{
    /**
     * Error Object
     *
     * @var object|null
     */
    public $err = null;

    /**
     * Success Response Object
     *
     * @var object|null
     */
    public $success = null;

    /**
     * @param $isError
     * @param $response
     * @return Response
     */
    public static function respond($isError, $response)
    {
        $responseObject = new Response();
        if ($isError) {
            $responseObject->err = $response;
        } else {
            $responseObject->success = $response;
        }

        return $responseObject;
    }
}
