<?php

namespace ImageKit\Url;

use ImageKit\ImageKit;
use ImageKit\Utils\Transformation;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Url
{
    const TRANSFORMATION_PARAMETER = 'tr';
    const SIGNATURE_PARAMETER = 'ik-s';
    const TIMESTAMP_PARAMETER = 'ik-t';
    const DEFAULT_TIMESTAMP = '9999999999';

    /**
     * @param $urlOptions
     * @return string
     */
    public function buildURL($urlOptions)
    {
        $obj = (object)($urlOptions);

        $path = null;
        $src = null;
        $urlEndpoint = $this->removeTrailingSlash($obj->urlEndpoint);
        $transformation = null;
        $signed = false;
        $expireSeconds = null;

        if (isset($obj->signed)) {
            $signed = $obj->signed;
        }

        if (isset($obj->expireSeconds)) {
            $expireSeconds = $obj->expireSeconds;

            if ($signed === true && $expireSeconds !== '' && !is_numeric($expireSeconds)) {
                throw new \InvalidArgumentException('expireSeconds should be numeric');
            }
        }

        if (isset($obj->path)) {
            $path = ltrim($obj->path, '/');
            $path = $this->addLeadingSlash($path);
        }

        if (isset($obj->src)) {
            $src = $obj->src;
        }

        if (isset($obj->transformation)) {
            $transformation = $obj->transformation;
        }

        if ($path == null && $src == null) {
            return '';
        }

        // Create Correct query parameter
        $parsedHost = '';

        if (!empty($path)) {
            $parsedURL = [parse_url($path)];
            $parsedHost = [parse_url($urlEndpoint)];
            $isSrcParameterUsedForURL = false;
        } else {
            $parsedURL = [parse_url($src)];
            $isSrcParameterUsedForURL = true;
        }

        //Initial URL Construction Object
        $urlArray = [
            'host' => '',
            'pathname' => '',
            'search' => [],
            'queryParameters' => [],
        ];
        $urlObject = (object)($urlArray);
        if (!empty($path)) {
            $urlObject->scheme = $parsedHost[0]['scheme'];
            $urlObject->host = $parsedHost[0]['host'];
            if (isset($parsedHost[0]['path'])) {
                $urlObject->pathname = $parsedHost[0]['path'];
            }
        } else {
            $urlObject->scheme = $parsedURL[0]['scheme'];
            $urlObject->host = $parsedURL[0]['host'];
            $urlObject->pathname = $parsedURL[0]['path'];
        }
        if (isset($parsedURL[0]['query'])) {
            parse_str($parsedURL[0]['query'], $urlObject->search);
        }
        if(isset($obj->transformationPosition)){
            if($obj->transformationPosition=='query'){
                if (isset($obj->queryParameters)) {
                    $urlObject->search = array_merge($urlObject->search, $obj->queryParameters);
                }
            }
            else if($obj->transformationPosition=='path'){
                if (isset($obj->queryParameters)) {
                    $urlObject->queryParameters = $obj->queryParameters;
                }
            }
            else{
                throw new \InvalidArgumentException(ErrorMessages::$URL_GENERATION_TRANSFORMATION_QUERY_INVALID['message']);
            }
            
        }
        else{
            if (isset($obj->queryParameters)) {
                $urlObject->queryParameters = $obj->queryParameters;
            }
        }


        ksort($urlObject->search);

        // Create Transformation String
        $transformationString = $this->constructTransformationString($transformation);
        if ($transformationString) {
            if (Transformation::addAsQueryParameter($urlOptions) || $isSrcParameterUsedForURL) {
                $transformationQueryParam = [self::TRANSFORMATION_PARAMETER => $transformationString];
                $urlObject->search = array_merge($transformationQueryParam, $urlObject->search);
            } else {
                $originalPath = $this->removeTrailingSlash($urlObject->pathname);
                $transformationQuery = self::TRANSFORMATION_PARAMETER;
                $transformationQuery .= Transformation::getChainTransformDelimiter();
                $transformationQuery .= $transformationString;
                if (!$this->startsWithSlash($originalPath)) {
                    $urlObject->pathname .= '/';
                }
                $urlObject->pathname = $originalPath;
                $urlObject->pathname .= '/';
                $urlObject->pathname .= $transformationQuery;
            }
        }
        $urlObject->pathname .= $this->addLeadingSlash($path);
        $urlObject->host = $this->removeTrailingSlash($urlObject->host);
        $urlObject->pathname = $this->addLeadingSlash($urlObject->pathname);

        // Build Search Params here
        $urlObject->search = urldecode(http_build_query($urlObject->search));

        // Build queryParameters here
        $urlObject->queryParameters = urldecode(http_build_query($urlObject->queryParameters));

        // transformationPosition
        $urlObject->transformationPosition = $obj->transformationPosition;
        // Signature String and Timestamp
        // We can do this only for URLs that are created using urlEndpoint and path parameter
        // because we need to know the endpoint to be able to remove it from the URL to create a signature
        // for the remaining. With the src parameter, we would not know the "pattern" in the URL
        if ($signed === true) {
            $expiryTimestamp = $this->getSignatureTimestamp($expireSeconds);
            $myArray = json_decode(json_encode($urlObject), true);
            $intermediateURL = $this->unparsed_url($myArray);
            $urlSignatureArray = [
                'privateKey' => $urlOptions['privateKey'],
                'url' => $intermediateURL,
                'urlEndpoint' => $urlOptions['urlEndpoint'],
                'expiryTimestamp' => $expiryTimestamp,
            ];
            
            $urlSignature = $this->getSignature($urlSignatureArray);
            if ($expiryTimestamp && $expiryTimestamp != self::DEFAULT_TIMESTAMP) {
                $timestampParameter = [
                    self::TIMESTAMP_PARAMETER => $expiryTimestamp
                ];
                $timestampParameterString = http_build_query($timestampParameter);
                $urlObject->timestampParameterString = $timestampParameterString;
            }
            $signatureParameter = [
                self::SIGNATURE_PARAMETER => $urlSignature
            ];
            $signatureParameterString = http_build_query($signatureParameter);
            
            $urlObject->signatureParameterString = $signatureParameterString;
        }
        $urlObjectArray = json_decode(json_encode($urlObject), true);

        return $this->unparsed_url($urlObjectArray);
    }

    /**
     * @param $str
     * @return false|mixed|string
     */
    private function removeTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and substr($str, -1) == '/') {
            $str = substr($str, 0, -1);
        }
        return $str;
    }

    /**
     * @param $str
     * @return mixed|string
     */
    private function addLeadingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and $str[0] != '/') {
            $str = '/' . $str;
        }
        return $str;
    }

    /**
     * @param $transformation
     * @return string
     */
    private function constructTransformationString($transformation)
    {
        if (!is_array($transformation)) {
            return '';
        }
        $parsedTransforms = [];
        for ($i = 0; $i < count($transformation); $i++) {
            $parsedTransformStep = [];
            foreach ($transformation[$i] as $key => $value) {
                if($key=='raw'){
                    array_push($parsedTransformStep, $value);    
                }
                else if($key!=''){
                        $transform_block = $this->buildingTransformationBlocks($key,$value);
                        array_push($parsedTransformStep, $transform_block);
                }
                
            }
                $delimiter = Transformation::getTransformDelimiter();
                $List = implode($delimiter, $parsedTransformStep);
                array_push($parsedTransforms, $List);
        }
        $setChainDelimiter = Transformation::getChainTransformDelimiter();
        return implode($setChainDelimiter, $parsedTransforms);
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    private function buildingTransformationBlocks($key, $value){
        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        $value = (string)$value;
        $transformKey = Transformation::getTransformKey($key);
        if (empty($transformKey)) {
            return [];
        }
        if ((empty($value) && $value !== '0') || $value === '-') {
            return $transformKey;
        } else {
            $transformationUtils = Transformation::getTransformKeyValueDelimiter();
            $finalTransformation = $transformKey . $transformationUtils;
            if (strpos($value, '/') !== false) {
                $finalTransformation .= str_replace('/', '@@', rtrim(ltrim($value, '/'), '/'));
            } else {
                $finalTransformation .= $value;
            }
            
            return $finalTransformation;
        }
    }

    /**
     * @param $string
     * @return bool
     */
    private function startsWithSlash($string)
    {
        $len = strlen('/');
        return (substr($string, 0, $len) === '/');
    }

    /**
     * @param $expireSeconds
     * @return string
     */
    private function getSignatureTimestamp($expireSeconds)
    {
        if (empty($expireSeconds)) {
            return self::DEFAULT_TIMESTAMP;
        }
        $sec = intval($expireSeconds);
        if (empty($sec)) {
            return self::DEFAULT_TIMESTAMP;
        }
        $currentTimestamp = time();
        return (string)($currentTimestamp + $sec);
    }

    /**
     * @param array $parsed
     * @return string
     */
    public function unparsed_url(array $parsed)
    {

        $get = function ($key) use ($parsed) {
            return isset($parsed[$key]) ? $parsed[$key] : null;
        };
        $scheme = $get('scheme');
        $host = $get('host');
        
        $pathname = $get('pathname');
        $last_slash_index = strripos($pathname,'/');
        $file_name = substr($pathname,$last_slash_index+1);
        $pathname = str_replace('/'.$file_name,'',$pathname);
        $pathname = $pathname.'/';
        $search = $get('search');
        $queryParameters = $get('queryParameters');
        $transformationPosition = $get('transformationPosition');

        $signatureParameterString = $get('signatureParameterString');

        $timestampParameterString = $get('timestampParameterString');

        if($transformationPosition=='query'){
            return (strlen($scheme) > 0 ? "$scheme:" : '') .
                (strlen($host) > 0 ? "//$host" : '') .
                (strlen($pathname) > 0 ? "$pathname" : '') .
                $file_name .
                (strlen($search) > 0 ? '?' .$search : '') .
                (strlen($timestampParameterString) > 0 ? ((strlen($search)?'&':'?') . $timestampParameterString): '') .
                (strlen($signatureParameterString) > 0 ? ('&' . $signatureParameterString): '');
        }
        else{

            return (strlen($scheme) > 0 ? "$scheme:" : '') .
                (strlen($host) > 0 ? "//$host" : '') .
                (strlen($pathname) > 0 ? "$pathname" : '') .
                (strlen($search) > 0 ? str_replace('=',':',$search).'/' : '') .
                 $file_name .
                 (strlen($queryParameters) > 0 ? ( '?' . $queryParameters): '') .
                 ((!empty($timestampParameterString) && strlen($timestampParameterString) > 0) ? (((!empty($queryParameters) && strlen($queryParameters)>0)?'&':'?') . $timestampParameterString): '') .
                 ((!empty($signatureParameterString) && strlen($signatureParameterString) > 0) ? ('&' . $signatureParameterString): '');

        }
    }

    /**
     * @param $options
     * @return false|string
     */
    public function getSignature($options)
    {
        if (empty($options['privateKey']) or empty($options['url']) or empty($options['urlEndpoint'])) {
            return '';
        } else {
            $data = (str_replace($this->addTrailingSlash($options['urlEndpoint']), '', $options['url']) . $options['expiryTimestamp']);
            return hash_hmac('sha1', $data, $options['privateKey']);
        }
    }

    /**
     * @param $str
     * @return string
     */
    private function addTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and substr($str, -1) != '/') {
            $str = $str . '/';
        }
        return $str;
    }
}