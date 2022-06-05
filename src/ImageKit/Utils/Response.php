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
        // echo json_encode($response);
        // die();
        if(is_array($response)){
            if($response['statusCode']==100){
                $response['statusCode']=null;
                $response['body'] = 'Network error occured';
                $isError=true;
            }
        }
        else{
            $response_obj = [];
            $response_obj['body'] = $response;
            $response_obj['statusCode']=null;
            $response_obj['headers']=[];
            $response = $response_obj;
        }
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
        // $responseObject->responseMetadata->statusCode = json_encode($response);

        return $responseObject;
    }
}
