<?php

namespace ImageKit\Utils;

use ImageKit\Constants\SupportedTransforms;
use ImageKit\Constants\ErrorMessages;

/**
 *
 */
class Transformation
{
    const DEFAULT_TRANSFORMATION_POSITION = 'path';
    const QUERY_TRANSFORMATION_POSITION = 'query';

    const CHAIN_TRANSFORM_DELIMITER = ':';
    const TRANSFORM_DELIMITER = ',';
    const TRANSFORM_KEY_VALUE_DELIMITER = '-';

    /**
     * @param $transformation
     * @return mixed
     */
    public static function getTransformKey($transformation)
    {
        $supportedTransforms = SupportedTransforms::get();

        if (isset($supportedTransforms[$transformation])) {
            return $supportedTransforms[$transformation];
        }

        return $transformation;    
    }

    /**
     * @return string
     */
    public static function getTransformKeyValueDelimiter()
    {
        return self::TRANSFORM_KEY_VALUE_DELIMITER;
    }

    /**
     * @return string
     */
    public static function getTransformDelimiter()
    {
        return self::TRANSFORM_DELIMITER;
    }

    /**
     * @return string
     */
    public static function getChainTransformDelimiter()
    {
        return self::CHAIN_TRANSFORM_DELIMITER;
    }

    /**
     * @param $options
     * @return bool
     */
    public static function addAsQueryParameter($options)
    {
        $optionsObject = (object)($options);
        if (isset($optionsObject->transformationPosition)) {
            return $optionsObject->transformationPosition === self::QUERY_TRANSFORMATION_POSITION;
        }
        return false;
    }

}
