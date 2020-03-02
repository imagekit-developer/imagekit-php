<?php

namespace ImageKit\Tests\ImageKit\Signature;

use ImageKit\Signature\Signature;
use PHPUnit\Framework\TestCase;
use Faker;

class SignatureTest  extends TestCase
{

    public function testGetAuthenticationParameters()
    {
        $defaultOptions = array(
            'publicKey' => 'publicKey',
            'privateKey' => 'privateKey',
            'urlEndpoint' => 'urlEndpoint',
            'transformationPosition' => "path"
        );

        $token = "token";
        $expire = "1582269249";
        $signature =   hash_hmac('sha1', $token . $expire, $defaultOptions['privateKey']);

        $signatureInstance = new Signature();
        $response = $signatureInstance->getAuthenticationParameters($token, $expire, $defaultOptions);
        $this->assertEquals(array(
            "token" => $token,
            "expire" => $expire,
            "signature" => $signature,
        ), $response);
    }
}
