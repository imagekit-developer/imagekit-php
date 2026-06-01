<?php

namespace Tests\Services\Assets;

use ImageKit\Assets\Bulk\BulkDeleteResponse;
use ImageKit\Assets\BulkTagUpdateResult;
use ImageKit\Client;
use ImageKit\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->delete(
            assetIDs: ['598821f949c0a938d57563bd', '6441fce4e809dd54b0dee029']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->delete(
            assetIDs: ['598821f949c0a938d57563bd', '6441fce4e809dd54b0dee029']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkDeleteResponse::class, $result);
    }

    #[Test]
    public function testAddTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->addTags(
            assetIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkTagUpdateResult::class, $result);
    }

    #[Test]
    public function testAddTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->addTags(
            assetIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            tags: ['t-shirt', 'round-neck', 'sale2019'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkTagUpdateResult::class, $result);
    }

    #[Test]
    public function testRemoveTags(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->removeTags(
            assetIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkTagUpdateResult::class, $result);
    }

    #[Test]
    public function testRemoveTagsWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->assets->bulk->removeTags(
            assetIDs: ['598821f949c0a938d57563bd', '598821f949c0a938d57563be'],
            aiTags: ['string'],
            tags: ['sale2019'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkTagUpdateResult::class, $result);
    }
}
