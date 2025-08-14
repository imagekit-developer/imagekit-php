<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Purge\PurgeExecuteParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PurgeTest extends TestCase
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
    public function testExecute(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = PurgeExecuteParams::with(
            url: 'https://ik.imagekit.io/your_imagekit_id/default-image.jpg'
        );
        $result = $this->client->files->purge->execute($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testExecuteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = PurgeExecuteParams::with(
            url: 'https://ik.imagekit.io/your_imagekit_id/default-image.jpg'
        );
        $result = $this->client->files->purge->execute($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testStatus(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->purge->status('requestId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
