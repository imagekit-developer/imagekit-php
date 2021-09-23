<?php

namespace ImageKit\Phash;


use ImageKit\Constants\ErrorMessages;
use InvalidArgumentException;

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
     */
    public static function pHashDistance($firstHash, $secondHash)
    {
        if (empty($firstHash) or empty($secondHash)) {
            throw new InvalidArgumentException(ErrorMessages::$MISSING_PHASH_VALUE);
        }

        if (!ctype_xdigit($firstHash) || !ctype_xdigit($firstHash)) {
            throw new InvalidArgumentException(ErrorMessages::$MISSING_PHASH_VALUE);
        }

        if (strlen((string)$firstHash) != strlen((string)$secondHash)) {
            throw new InvalidArgumentException(ErrorMessages::$MISSING_PHASH_VALUE);
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

    /**
     * Similarity Score
     *
     * @param $hammingDistance
     *
     * @return float
     *
     */
    public static function similarityScore($hammingDistance)
    {
        return 1 - ($hammingDistance / 64.0);
    }

}
