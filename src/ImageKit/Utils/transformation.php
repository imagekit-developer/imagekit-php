<?php

const DEFAULT_TRANSFORMATION_POSITION = "path";
const QUERY_TRANSFORMATION_POSITION = "query";
const VALID_TRANSFORMATION_POSITIONS = [DEFAULT_TRANSFORMATION_POSITION, QUERY_TRANSFORMATION_POSITION];

// const supportedTransforms = require("../Constants/supportedTransforms");
const CHAIN_TRANSFORM_DELIMITER = ":";
const TRANSFORM_DELIMITER = ",";
const TRANSFORM_KEY_VALUE_DELIMITER = "-";

include_once __DIR__ . '/../Constants/supportedTransforms.php';

function getDefault()
{
    return DEFAULT_TRANSFORMATION_POSITION;
}

function getTransformKey($transformation)
{
    if (empty($transformation)) {
        return "";
    }

    $supportedTransforms = getSupportedTransformations();

    $res = "";
    if (isset($supportedTransforms->$transformation)) {
        $res = $supportedTransforms->$transformation;
    } else {
        $res = $transformation;
    }

    return $res;
}

function getTransformKeyValueDelimiter()
{
    return TRANSFORM_KEY_VALUE_DELIMITER;
}

function getTransformDelimiter()
{
    return TRANSFORM_DELIMITER;
}

function getChainTransformDelimiter()
{
    return CHAIN_TRANSFORM_DELIMITER;
}

function addAsQueryParameter($options)
{
    // return options.transformationPosition === QUERY_TRANSFORMATION_POSITION;
    $optionsObject = (object) ($options);
    if (isset($optionsObject->transformationPosition)) {
        return $optionsObject->transformationPosition === QUERY_TRANSFORMATION_POSITION;
    }

    return false;
}
