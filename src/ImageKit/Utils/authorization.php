<?php

function addAuthorization(array $opts, array $defaultOptions)
{
    $defaultOptionsObj = (object) $defaultOptions;
    $privateKey = $defaultOptionsObj->privateKey;
    $authorization = array(
        "auth" => array(
            $privateKey, ""
        )
    );

    return array_merge($opts, $authorization);
}
