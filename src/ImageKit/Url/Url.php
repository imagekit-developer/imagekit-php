<?php

namespace ImageKit\Url;

include_once __DIR__ . "/../Utils/transformation.php";
$composer = json_decode(
    file_get_contents(__DIR__ . "/../../../composer.json"),
    true
);
define("SDK_VERSION", $composer["version"]);
define("TRANSFORMATION_PARAMETER", "tr");
define("SIGNATURE_PARAMETER", "ik-s");
define("TIMESTAMP_PARAMETER", "ik-t");
define("DEFAULT_TIMESTAMP", "9999999999");
define("PROTOCOL_QUERY", "/http[s]?\:\/\//");
class Url
{
    public  function buildURL($urlOptions)
    {
        $obj = (object) ($urlOptions);
        $path = null;
        $queryParam = array();
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
        }
        if (isset($obj->path)) {
            $path = $this->addLeadingSlash($obj->path);
        }
        if (isset($obj->src)) {
            $src = $obj->src;
        }
        if (isset($obj->transformation)) {
            $transformation = $obj->transformation;
        }
        if ($path == null && $src == null) {
            return "";
        }
        // Create Correct query parameter
        $parsedURL = "";
        $isSrcParameterUsedForURL = "";
        $parsedHost = "";
        if (!empty($path)) {
            $parsedURL = array(parse_url($path));
            $parsedHost = array(parse_url($urlEndpoint));
            $isSrcParameterUsedForURL = false;
        } else {
            $parsedURL = array(parse_url($src));
            $isSrcParameterUsedForURL = true;
        }
        //Initial URL Construction Object
        $urlArray = array(
            'host' => "",
            'pathname' => "",
            'search' => "",
        );
        $urlObject = (object) ($urlArray);
        if (!empty($path)) {
            $urlObject->scheme = $parsedHost[0]['scheme'];
            $urlObject->host = $parsedHost[0]['host'];
            $urlObject->pathname = $parsedHost[0]['path'];
        } else {
            $urlObject->scheme = $parsedURL[0]['scheme'];
            $urlObject->host = $parsedURL[0]['host'];
            $urlObject->pathname = $parsedURL[0]['path'];
        }
        // Create Transformation String
        $queryParameters = '';
        $transformationString = $this->constructTransformationString($transformation);
        if ($transformationString) {
            if (addAsQueryParameter($urlOptions) || $isSrcParameterUsedForURL) {
                $transformationQueryParam = array(TRANSFORMATION_PARAMETER => $transformationString);
                $queryParameters = http_build_query($transformationQueryParam, '', \CHAIN_TRANSFORM_DELIMITER);
            } else {
                $originalPath = $this->removeTrailingSlash($urlObject->pathname);
                $transformationQuery = TRANSFORMATION_PARAMETER;
                $transformationQuery .= CHAIN_TRANSFORM_DELIMITER;
                $transformationQuery .= $transformationString;
                if (!$this->startsWith($originalPath, "/")) {
                    $urlObject->pathname .= "/";
                }
                $urlObject->pathname = $originalPath;
                $urlObject->pathname .= "/";
                $urlObject->pathname .= $transformationQuery;
            };
        }
        if (isset($obj->queryParameters)) {
            // merge
            if ($queryParameters == '') {
                $queryParameters = http_build_query($obj->queryParameters);
            } else {
                // merge the query parameters
                $queryParameters .= '&' . http_build_query($obj->queryParameters);
            }
        }
        $urlObject->pathname .= $this->addLeadingSlash($path);
        $urlObject->host = $this->removeTrailingSlash($urlObject->host);
        $urlObject->pathname = $this->addLeadingSlash($urlObject->pathname);
        $urlObject->search = $queryParameters;
        // Signature String and Timestamp
        // We can do this only for URLs that are created using urlEndpoint and path parameter
        // because we need to know the endpoint to be able to remove it from the URL to create a signature
        // for the remaining. With the src parameter, we would not know the "pattern" in the URL
        $expiryTimestamp = "";
        if ($signed === true and !$isSrcParameterUsedForURL) {
            if (!empty($expireSeconds)) {
                $expiryTimestamp = $this->getSignatureTimestamp($expireSeconds);
            } else {
                $expiryTimestamp = DEFAULT_TIMESTAMP;
            }
            $myArray = json_decode(json_encode($urlObject), true);
            $intermediateURL = $this->unparsed_url($myArray);
            $urlSignatureArray = array(
                'privateKey' => $urlOptions['privateKey'],
                'url' => $intermediateURL,
                'urlEndpoint' => $urlOptions['urlEndpoint'],
                'expiryTimestamp' => $expiryTimestamp,
            );
            $urlSignature = $this->getSignature($urlSignatureArray);
            if ($expiryTimestamp && $expiryTimestamp != DEFAULT_TIMESTAMP) {
                $timestampParameter = array(
                    TIMESTAMP_PARAMETER => $expiryTimestamp
                );
                $timestampParameterString = http_build_query($timestampParameter);
                if ($urlObject->search === '') {
                    $urlObject->search .= $timestampParameterString;
                } else {
                    $urlObject->search .= "&" . $timestampParameterString;
                }
            }
            $signatureParameter = array(
                SIGNATURE_PARAMETER => $urlSignature
            );
            $signatureParameterString = http_build_query($signatureParameter);
            if ($urlObject->search === '') {
                $urlObject->search .= $signatureParameterString;
            } else {
                $urlObject->search .= "&" . $signatureParameterString;
            }
        }
        $urlObjectArray = json_decode(json_encode($urlObject), true);
        return $this->unparsed_url($urlObjectArray);
    }
    function unparsed_url(array $parsed)
    {
        $get = function ($key) use ($parsed) {
            return isset($parsed[$key]) ? $parsed[$key] : null;
        };
        $scheme = $get('scheme');
        $host = $get('host');
        $pathname = $get('pathname');
        $search = $get('search');
        $url =
            (strlen($scheme) > 0 ? "$scheme:" : '') .
            (strlen($host) > 0 ? "//$host" : '') .
            (strlen($pathname) > 0 ? "$pathname" : '') .
            (strlen($search) > 0 ? "?$search" : '') .
            (strlen($search) > 0 ? "&ik-sdk-version=php-" . SDK_VERSION : "?ik-sdk-version=php-" . SDK_VERSION);
        return $url;
    }
    private function constructTransformationString($transformation)
    {
        if (!is_array($transformation)) {
            return "";
        }
        $parsedTransforms = array();
        for ($i = 0; $i < count($transformation); $i++) {
            $parsedTransformStep = array();
            foreach ($transformation[$i] as $key => $value) {
                $transformKey = getTransformKey($key);
                if ($key === "lossless" || $key === "progressive" || $key === "trim") {
                    if ($value === false) {
                        $value = "false";
                    } else if ($value === true) {
                        $value = "true";
                    }
                }
                if (empty($transformKey)) {
                    $transformKey = $key;
                }
                if ($transformation[$i][$key] === "-") {
                    array_push($parsedTransformStep, $transformKey);
                } else {
                    $transformationUtils = getTransformKeyValueDelimiter();
                    $finalres = $transformKey;
                    $finalres .= $transformationUtils;
                    if (strpos($value, '/') !== false) {
                        $finalres .= str_replace('/', '@@', $value);
                    } else {
                        $finalres .= $value;
                    }
                    array_push($parsedTransformStep, $finalres);
                }
            }
            $getDelimiter = getTransformDelimiter();
            $List = implode(',', $parsedTransformStep);
            array_push($parsedTransforms, $List);
        }
        $setChainDeleimiter = getChainTransformDelimiter();
        $FinalList = $parsedTransforms;
        return implode(":", $parsedTransforms);
    }
    private function addLeadingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and $str[0] != "/") {
            $str = "/" . $str;
        }
        return $str;
    }
    private function addTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and substr($str, -1) != "/") {
            $str = $str . "/";
        }
        return $str;
    }
    private function removeTrailingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and substr($str, -1) == "/") {
            $str = substr($str, 0, -1);
        }
        return $str;
    }
    private function removeLeadingSlash($str)
    {
        if (is_string($str) and strlen($str) > 0 and $str[0] == "/") {
            $str = substr($str, 1, -1);
        }
        return $str;
    }
    private function getSignatureTimestamp($expireSeconds)
    {
        if (empty($expireSeconds)) {
            return DEFAULT_TIMESTAMP;
        }
        $sec = intVal($expireSeconds, 10);
        if (empty($sec)) {
            return DEFAULT_TIMESTAMP;
        }
        $currentTimestamp = time();
        return $currentTimestamp + $sec;
    }
    public function getSignature($options)
    {
        if (empty($options['privateKey']) or empty($options['url']) or empty($options['urlEndpoint'])) {
            return "";
        } else {
            $data = (str_replace($this->addTrailingSlash($options['urlEndpoint']), '', $options['url']) . $options['expiryTimestamp']);
            return hash_hmac('sha1', $data, $options['privateKey']);
        }
    }
    // Function to check string starting
    // with given substring
    private function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
    // Function to check the string is ends
    // with given substring or not
    function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }
}
