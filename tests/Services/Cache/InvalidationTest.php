<?php

namespace Tests\Services\Cache;

use Imagekit\Cache\Invalidation\InvalidationGetResponse;
use Imagekit\Cache\Invalidation\InvalidationNewResponse;
use Imagekit\Client;
use Imagekit\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class InvalidationTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->cache->invalidation->create(
            url: 'https://ik.imagekit.io/your_imagekit_id/default-image.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvalidationNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->cache->invalidation->create(
            url: 'https://ik.imagekit.io/your_imagekit_id/default-image.jpg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvalidationNewResponse::class, $result);
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->cache->invalidation->get('requestId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InvalidationGetResponse::class, $result);
    }
}
