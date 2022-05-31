<?php

namespace ImageKit\Constants;

/**
 *
 */
class SupportedOperands
{
    private static $transforms = [
        '==' => 'eq',
        '!=' => 'ne',
        '>' => 'gt',
        '>=' => 'gte',
        '<' => 'lt',
        '<=' => 'lte',
    ];

    /**
     * @return array<string, string>
     */
    public static function get()
    {
        return self::$transforms;
    }
}
