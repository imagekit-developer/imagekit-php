<?php
namespace ImageKit\Tests\ImageKit\Signature;

use ImageKit\Signature\Signature;
use PHPUnit\Framework\TestCase;

class SignatureTest  extends TestCase
{

    public function testGetAuthenticationParameters()
    {
        $token = "kishan";
        $expire = "100";

        $defaultOptions = array(
            'publicKey' => "public_Mo3UCmhjJ2iq89n2xQ5va1jgrds=",
            'privateKey' => "private_2yk2tYC0bcPiNHVG3s4Dpa6Wfzo=",
            'urlEndpoint' => "https://ik.imagekit.io/ot2cky3ujwa/",
            'transformationPosition' => "path"
        );

        $signature = new Signature();
        $response = $signature->getAuthenticationParameters($token, $expire, $defaultOptions );
        $this->assertEquals( array(
            "token" => "kishan",
            "expire" => 100,
            "signature" =>"6a5d436b803e74593ffbf78bf52e55a2417db910",
        ), $response);


    }
}
