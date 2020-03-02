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
            "publicKey" => "public_key_test",
            "privateKey" => "private_key_test",
            "urlEndpoint" => "https://test-domain.com/test-endpoint"
        );

        $token = "your_token";
        $expire = "1582269249";
        $signature = 'e71bcd6031016b060d349d212e23e85c791decdd';

        $signatureInstance = new Signature();
        $response = $signatureInstance->getAuthenticationParameters($token, $expire, $defaultOptions);
        $this->assertEquals(array(
            "token" => $token,
            "expire" => $expire,
            "signature" => $signature,
        ), $response);
    }
}
