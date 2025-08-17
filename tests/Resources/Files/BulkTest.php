<?php

namespace Tests\Resources\Files;

use ImageKit\Client;
use ImageKit\Files\Bulk\BulkAddTagsParams;
use ImageKit\Files\Bulk\BulkDeleteParams;
use ImageKit\Files\Bulk\BulkRemoveAITagsParams;
use ImageKit\Files\Bulk\BulkRemoveTagsParams;
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

        $params = BulkDeleteParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );
        $result = $this->client->files->bulk->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkDeleteParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );
        $result = $this->client->files->bulk->delete($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkAddTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->bulk->addTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testAddTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkAddTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->bulk->addTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkRemoveAITagsParams::with(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );
        $result = $this->client->files->bulk->removeAITags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveAITagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkRemoveAITagsParams::with(
            aiTags: ['t-shirt', 'round-neck', 'sale2019'],
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        );
        $result = $this->client->files->bulk->removeAITags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkRemoveTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->bulk->removeTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRemoveTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkRemoveTagsParams::with(
            fileIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );
        $result = $this->client->files->bulk->removeTags($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
