<?php

namespace ImageKit\Phash;

use Exception;
use ImageKit\Constants\ErrorMessages;

/**
 *
 */

/**
 *
 */
class Phash
{
    /**
     * Use pHash to find similar or duplicate images
     *
     * @link https://docs.imagekit.io/api-reference/metadata-api#calculate-phash-distance
     *
     * @param $firstHash
     * @param $secondHash
     * @return int
     *
     * @throws Exception
     */
    public static function pHashDistance($firstHash, $secondHash)
    {
        if (empty($firstHash) or empty($secondHash)) {
            throw new Exception(ErrorMessages::$MISSING_PHASH_VALUE['message']);
        }

        if (!ctype_xdigit($firstHash) || !ctype_xdigit($firstHash)) {
            throw new Exception(ErrorMessages::$INVALID_PHASH_VALUE['message']);
        }

        if (strlen((string)$firstHash) != strlen((string)$secondHash)) {
            throw new Exception(ErrorMessages::$INVALID_PHASH_VALUE['message']);
        }

        $counts = [0, 1, 1, 2, 1, 2, 2, 3, 1, 2, 2, 3, 2, 3, 3, 4];
        $res = 0;
        for ($i = 0; $i < 16; $i++) {
            if ($firstHash[$i] != $secondHash[$i]) {
                $res += $counts[hexdec($firstHash[$i]) ^ hexdec($secondHash[$i])];
            }
        }
        return $res;
    }

}
