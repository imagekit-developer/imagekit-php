<?php

namespace Tests\Resources\Accounts;

use ImageKit\Accounts\Origins\OriginCreateParams\Origin\S3;
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
            S3::with(
                accessKey: 'AKIATEST123',
                bucket: 'test-bucket',
                name: 'My S3 Origin',
                secretKey: 'secrettest123',
            ),
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
            S3::with(
                accessKey: 'AKIATEST123',
                bucket: 'test-bucket',
                name: 'My S3 Origin',
                secretKey: 'secrettest123',
            )
                ->withBaseURLForCanonicalHeader('https://cdn.example.com')
                ->withIncludeCanonicalHeader(false)
                ->withPrefix('images'),
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
            accessKey: 'AKIAIOSFODNN7EXAMPLE',
            bucket: 'gcs-media',
            name: 'US S3 Storage',
            secretKey: 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            type: 'AKENEO_PIM',
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            baseURL: 'https://akeneo.company.com',
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
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
            accessKey: 'AKIAIOSFODNN7EXAMPLE',
            bucket: 'gcs-media',
            name: 'US S3 Storage',
            secretKey: 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            type: 'AKENEO_PIM',
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            baseURL: 'https://akeneo.company.com',
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
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
