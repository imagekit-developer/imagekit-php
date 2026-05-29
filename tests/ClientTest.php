<?php

namespace Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use ImageKit\Core\Util;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ClientTest extends TestCase
{
    public function testDefaultHeaders(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;

        $transporter->setDefaultResponse($mockRsp);

        $client = new \ImageKit\Client(
            baseUrl: 'http://localhost',
            privateKey: 'My Private Key',
            password: 'My Password',
            requestOptions: ['transporter' => $transporter],
        );

        $client->STAINLESS_FIXME_dummy->STAINLESS_FIXME_create();

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);

        foreach (['accept', 'content-type'] as $header) {
            $sent = $requested->getHeaderLine($header);
            $this->assertNotEmpty($sent);
        }
    }
}
