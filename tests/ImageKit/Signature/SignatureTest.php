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
        $expire = "10000";

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
            "signature" =>"03d6a477325b8eef7bbefa1fdcf42e311a354b27",
        ), $response);


    }
}
