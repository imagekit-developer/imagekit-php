<?php

namespace Tests\Services\Files;

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
            privateKey: 'My Private Key',
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

        $result = $this->client->files->bulk->delete([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->delete([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAddTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->addTags([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAddTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->addTags([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRemoveAITags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeAITags([
            'AITags' => ['t-shirt', 'round-neck', 'sale2019'],
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRemoveAITagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeAITags([
            'AITags' => ['t-shirt', 'round-neck', 'sale2019'],
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRemoveTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeTags([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRemoveTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->files->bulk->removeTags([
            'fileIds' => ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            'tags' => ['t-shirt', 'round-neck', 'sale2019'],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
