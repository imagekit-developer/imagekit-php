<?php
namespace ImageKit\Tests\ImageKit\Signature;

use ImageKit\Signature\Signature;
use PHPUnit\Framework\TestCase;
use Faker;

class SignatureTest  extends TestCase
{

    public function testGetAuthenticationParameters()
    {
        $faker = Faker\Factory::create();
        $token = "token";
        $expire = "1582269249";

        $defaultOptions = array(
            'publicKey' => 'publicKey',
            'privateKey' => 'privateKey',
            'urlEndpoint' => 'urlEndpoint',
            'transformationPosition' => "path"
        );

        $signature = new Signature();
        $response = $signature->getAuthenticationParameters($token, $expire, $defaultOptions );
        $this->assertEquals(array(
            "token" => $token,
            "expire" => $expire,
            "signature" =>"e71bcd6031016b060d349d212e23e85c791decdd",
        ), $response);


    }
}
