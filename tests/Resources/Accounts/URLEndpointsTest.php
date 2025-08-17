<?php

namespace Tests\Resources\Accounts;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams;
use ImageKit\Accounts\URLEndpoints\URLEndpointUpdateParams\URLRewriter\CloudinaryURLRewriter as CloudinaryURLRewriter1;
use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class URLEndpointsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            privateAPIKey: 'My Private API Key',
            password: 'My Password',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = URLEndpointCreateParams::with(
            description: 'My custom URL endpoint'
        );
        $result = $this->client->accounts->urlEndpoints->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = URLEndpointCreateParams::with(
            description: 'My custom URL endpoint',
            origins: ['origin-id-1'],
            urlPrefix: 'product-images',
            urlRewriter: CloudinaryURLRewriter::with(type: 'CLOUDINARY')
                ->withPreserveAssetDeliveryTypes(true),
        );
        $result = $this->client->accounts->urlEndpoints->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = URLEndpointUpdateParams::with(
            description: 'My custom URL endpoint'
        );
        $result = $this->client->accounts->urlEndpoints->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = URLEndpointUpdateParams::with(
            description: 'My custom URL endpoint',
            origins: ['origin-id-1'],
            urlPrefix: 'product-images',
            urlRewriter: CloudinaryURLRewriter1::with(type: 'CLOUDINARY')
                ->withPreserveAssetDeliveryTypes(true),
        );
        $result = $this->client->accounts->urlEndpoints->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->urlEndpoints->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->urlEndpoints->delete('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->urlEndpoints->get('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
