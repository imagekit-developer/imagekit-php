<?php
namespace ImageKit\Phash;

include_once __DIR__ . "/../Constants/errorMessages.php";

class Phash
{
    public function pHashDistance($firstHash, $secondHash )
    {
        if(empty($firstHash) or empty($secondHash)){
            return respond(true, MISSING_PHASH_VALUE);
        }

        if(!ctype_xdigit($firstHash) || !ctype_xdigit($firstHash)){
            return respond(true, MISSING_PHASH_VALUE);
        }

        if(strlen((string) $firstHash)!= strlen((string)$secondHash))
        {
            return respond(true, UNEQUAL_STRING_LENGTH);
        }

            $counts = array(0,1,1,2,1,2,2,3,1,2,2,3,2,3,3,4);
            $res = 0;
            for ($i=0; $i<16; $i++) {
                if ($firstHash[$i] != $secondHash[$i]) {
                    $res += $counts[hexdec($firstHash[$i]) ^ hexdec($secondHash[$i])];
                }
            }
            return $res;

    }
}
