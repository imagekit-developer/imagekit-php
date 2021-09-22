<?php

namespace ImageKit\Utils;

/**
 *
 */

/**
 *
 */
class Response
{
    // callback function
    /**
     * @param $isError
     * @param $response
     * @return object
     */
    /**
     * @param $isError
     * @param $response
     * @return object
     */
    public static function respond($isError, $response)
    {
        if ($isError) {
            return (object)[
                'err' => $response,
                'success' => null
            ];
        } else {
            return (object)[
                'err' => null,
                'success' => $response
            ];
        }
    }
}
