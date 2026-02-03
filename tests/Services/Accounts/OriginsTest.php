<?php

namespace Tests\Services\Accounts;

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
final class OriginsTest extends TestCase
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

        $result = $this->client->accounts->origins->create(
            accessKey: 'AKIAIOSFODNN7EXAMPLE',
            bucket: 'gcs-media',
            name: 'US S3 Storage',
            secretKey: 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            baseURL: 'https://akeneo.company.com',
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->create(
            accessKey: 'AKIAIOSFODNN7EXAMPLE',
            bucket: 'gcs-media',
            name: 'US S3 Storage',
            secretKey: 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            type: 'AKENEO_PIM',
            baseURLForCanonicalHeader: 'https://cdn.example.com',
            includeCanonicalHeader: false,
            prefix: 'uploads',
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            s3ForcePathStyle: true,
            baseURL: 'https://akeneo.company.com',
            forwardHostHeaderToOrigin: false,
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
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
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            baseURL: 'https://akeneo.company.com',
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
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
            baseURLForCanonicalHeader: 'https://cdn.example.com',
            includeCanonicalHeader: false,
            prefix: 'uploads',
            endpoint: 'https://s3.eu-central-1.wasabisys.com',
            s3ForcePathStyle: true,
            baseURL: 'https://akeneo.company.com',
            forwardHostHeaderToOrigin: false,
            clientEmail: 'service-account@project.iam.gserviceaccount.com',
            privateKey: '-----BEGIN PRIVATE KEY-----\nMIIEv...',
            accountName: 'account123',
            container: 'images',
            sasToken: '?sv=2023-01-03&sr=c&sig=abc123',
            clientID: 'akeneo-client-id',
            clientSecret: 'akeneo-client-secret',
            password: 'strongpassword123',
            username: 'integration-user',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->get('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }
}
