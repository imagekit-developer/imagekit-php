<?php
namespace ImageKit\Tests\ImageKit\Phash;

use ImageKit\Phash\Phash;
use PHPUnit\Framework\TestCase;

final class PHashTest extends TestCase
{
    public function testPHashDistanceForSameImage()
    {
        $firstHash = "f06830ca9f1e3e90";
        $secondHash = "f06830ca9f1e3e90";

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash );
        $this->assertEquals( 0, $response);
    }

    public function testPHashDistanceForSimilarImages()
    {
        $firstHash = "2d5ad3936d2e015b";
        $secondHash = "2d6ed293db36a4fb";

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash );
        $this->assertEquals( 17, $response);
    }
    public function testPHashDistanceForDissimilarImages()
    {
        $firstHash = "a4a65595ac94518b";
        $secondHash = "7838873e791f8400";

        $pHash = new Phash();
        $response = $pHash->pHashDistance($firstHash, $secondHash );
        $this->assertEquals( 37, $response);
    }
}
