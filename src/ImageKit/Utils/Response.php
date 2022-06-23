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
    public $error = null;

    /**
     * Success Response Object
     *
     * @var object|null
     */
    public $result = null;

    /**
     * Response Metadata Response Object
     *
     * @var object|null
     */
    public $responseMetadata = [
        'headers'=>null,
        'raw'=>null,
        'statusCode'=>null
    ];

    /**
     * @param $isError
     * @param $response
     * @return Response
     */
    public static function respond($isError, $response)
    {
        $responseObject = new Response();
        if($response && is_array($response)){
            if ($isError) {
                $responseObject->error = $response['body'];
            } else {
                $responseObject->result = $response['body'];
            }
            $headers = [];
            foreach ($response['headers'] as $key => $value) {
                if(is_array($value)){
                    $headers[$key] = implode(',',$value);
                }
                else{
                    $headers[$key] = $value;
                }
            }
            
            $responseObject->responseMetadata['headers'] = $headers;
            $responseObject->responseMetadata['raw'] = $response['body'];
            $responseObject->responseMetadata['statusCode'] = $response['statusCode'];
            
        }
        else{
            $responseObject->error = $response;
            $responseObject->responseMetadata = null;
        }
        
        return $responseObject;
    }
}
