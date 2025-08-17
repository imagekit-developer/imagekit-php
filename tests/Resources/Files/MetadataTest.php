<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Metadata\MetadataGetFromURLParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class MetadataTest extends TestCase
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
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->metadata->get('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGetFromURL(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = MetadataGetFromURLParams::with(url: 'https://example.com');
        $result = $this->client->files->metadata->getFromURL($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGetFromURLWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = MetadataGetFromURLParams::with(url: 'https://example.com');
        $result = $this->client->files->metadata->getFromURL($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
