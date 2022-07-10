<?php

namespace ImageKit\Utils;

use ImageKit\Configuration\Configuration;

/**
 *
 */
class Authorization
{
    /**
     * @param Configuration $configuration
     * @return array[]
     */
    public static function addAuthorization(Configuration $configuration,$handlerStack=null)
    {
        return [
            'auth' => [
                $configuration->privateKey, ''
            ],
            'handler'=>$handlerStack
        ];
    }
}

