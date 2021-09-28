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
    public static function addAuthorization(Configuration $configuration)
    {
        return [
            'auth' => [
                $configuration->privateKey, ''
            ]
        ];
    }
}

