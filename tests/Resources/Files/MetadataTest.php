<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Metadata\MetadataFromURLParams;
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->metadata->retrieve('fileId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testFromURL(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = MetadataFromURLParams::with(url: 'url');
        $result = $this->client->files->metadata->fromURL($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testFromURLWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = MetadataFromURLParams::with(url: 'url');
        $result = $this->client->files->metadata->fromURL($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
