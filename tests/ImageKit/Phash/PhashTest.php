<?php

namespace ImageKit\Tests\ImageKit\Phash;

use ImageKit\Phash\Phash;
use PHPUnit\Framework\TestCase;

/**
 *
 */

/**
 *
 */
final class PhashTest extends TestCase
{
    /**
     *
     */
    public function testPHashDistanceForSameImage()
    {
        $firstHash = '33699c96619cc69e';
        $secondHash = '33699c96619cc69e';

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash);
        PhashTest::assertEquals(0, $response);
    }

    /**
     *
     */
    public function testPHashDistanceForSimilarImages()
    {
        $firstHash = '2d5ad3936d2e015b';
        $secondHash = '2d6ed293db36a4fb';

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash);
        PhashTest::assertEquals(17, $response);
    }

    /**
     *
     */
    public function testPHashDistanceForDissimilarImages()
    {
        $firstHash = '33699c96619cc69e';
        $secondHash = '968e978414fe04ea';

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash);
        PhashTest::assertEquals(30, $response);
    }
}
