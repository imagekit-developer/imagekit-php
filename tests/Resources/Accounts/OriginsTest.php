<?php

namespace Tests\Resources\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams\Body;
use ImageKit\Accounts\Origins\OriginUpdateParams\Body as Body1;
use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class OriginsTest extends TestCase
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

        $result = $this->client->accounts->origins->create(
            Body::with(STAINLESS_FIXME_name: 'name', STAINLESS_FIXME_type: 'S3')
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->create(
            Body::with(STAINLESS_FIXME_name: 'name', STAINLESS_FIXME_type: 'S3')
                ->STAINLESS_FIXME_withAccessKey('x')
                ->STAINLESS_FIXME_withAccountName('x')
                ->STAINLESS_FIXME_withBaseURL('https://example.com')
                ->STAINLESS_FIXME_withBaseURLForCanonicalHeader('https://example.com')
                ->STAINLESS_FIXME_withBucket('x')
                ->STAINLESS_FIXME_withClientEmail('dev@stainless.com')
                ->STAINLESS_FIXME_withClientID('x')
                ->STAINLESS_FIXME_withClientSecret('x')
                ->STAINLESS_FIXME_withContainer('x')
                ->STAINLESS_FIXME_withEndpoint('https://example.com')
                ->STAINLESS_FIXME_withForwardHostHeaderToOrigin(true)
                ->STAINLESS_FIXME_withIncludeCanonicalHeader(true)
                ->STAINLESS_FIXME_withPassword('x')
                ->STAINLESS_FIXME_withPrefix('prefix')
                ->STAINLESS_FIXME_withPrivateKey('x')
                ->STAINLESS_FIXME_withS3ForcePathStyle(true)
                ->STAINLESS_FIXME_withSasToken('x')
                ->STAINLESS_FIXME_withSecretKey('x')
                ->STAINLESS_FIXME_withUsername('x'),
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->update(
            'id',
            Body1::with(STAINLESS_FIXME_name: 'name', STAINLESS_FIXME_type: 'S3'),
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->update(
            'id',
            Body1::with(STAINLESS_FIXME_name: 'name', STAINLESS_FIXME_type: 'S3')
                ->STAINLESS_FIXME_withAccessKey('x')
                ->STAINLESS_FIXME_withAccountName('x')
                ->STAINLESS_FIXME_withBaseURL('https://example.com')
                ->STAINLESS_FIXME_withBaseURLForCanonicalHeader('https://example.com')
                ->STAINLESS_FIXME_withBucket('x')
                ->STAINLESS_FIXME_withClientEmail('dev@stainless.com')
                ->STAINLESS_FIXME_withClientID('x')
                ->STAINLESS_FIXME_withClientSecret('x')
                ->STAINLESS_FIXME_withContainer('x')
                ->STAINLESS_FIXME_withEndpoint('https://example.com')
                ->STAINLESS_FIXME_withForwardHostHeaderToOrigin(true)
                ->STAINLESS_FIXME_withIncludeCanonicalHeader(true)
                ->STAINLESS_FIXME_withPassword('x')
                ->STAINLESS_FIXME_withPrefix('prefix')
                ->STAINLESS_FIXME_withPrivateKey('x')
                ->STAINLESS_FIXME_withS3ForcePathStyle(true)
                ->STAINLESS_FIXME_withSasToken('x')
                ->STAINLESS_FIXME_withSecretKey('x')
                ->STAINLESS_FIXME_withUsername('x'),
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->delete('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->get('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
