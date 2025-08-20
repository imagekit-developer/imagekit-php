<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BulkTest extends TestCase
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

        $result = $this->client->files->bulk->delete(
            ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->delete(
            ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->addTags(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->addTags(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeAITags(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeAITags(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeTags(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeTags(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
