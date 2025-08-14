<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Batch\BatchDeleteParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BatchTest extends TestCase
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
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BatchDeleteParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );
        $result = $this->client->files->batch->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BatchDeleteParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );
        $result = $this->client->files->batch->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
