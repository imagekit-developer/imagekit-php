<?php

namespace Tests\Services\Accounts;

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

        $result = $this->client->accounts->origins->create([
            'accessKey' => 'AKIAIOSFODNN7EXAMPLE',
            'bucket' => 'gcs-media',
            'name' => 'US S3 Storage',
            'secretKey' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            'type' => 'AKENEO_PIM',
            'endpoint' => 'https://s3.eu-central-1.wasabisys.com',
            'baseUrl' => 'https://akeneo.company.com',
            'clientEmail' => 'service-account@project.iam.gserviceaccount.com',
            'privateKey' => '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
            'accountName' => 'account123',
            'container' => 'images',
            'sasToken' => '?sv=2023-01-03&sr=c&sig=abc123',
            'clientId' => 'akeneo-client-id',
            'clientSecret' => 'akeneo-client-secret',
            'password' => 'strongpassword123',
            'username' => 'integration-user',
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->create([
            'accessKey' => 'AKIAIOSFODNN7EXAMPLE',
            'bucket' => 'gcs-media',
            'name' => 'US S3 Storage',
            'secretKey' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
            'type' => 'AKENEO_PIM',
            'endpoint' => 'https://s3.eu-central-1.wasabisys.com',
            'baseUrl' => 'https://akeneo.company.com',
            'clientEmail' => 'service-account@project.iam.gserviceaccount.com',
            'privateKey' => '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
            'accountName' => 'account123',
            'container' => 'images',
            'sasToken' => '?sv=2023-01-03&sr=c&sig=abc123',
            'clientId' => 'akeneo-client-id',
            'clientSecret' => 'akeneo-client-secret',
            'password' => 'strongpassword123',
            'username' => 'integration-user',
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->update(
            'id',
            [
                'accessKey' => 'AKIAIOSFODNN7EXAMPLE',
                'bucket' => 'gcs-media',
                'name' => 'US S3 Storage',
                'secretKey' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
                'type' => 'AKENEO_PIM',
                'endpoint' => 'https://s3.eu-central-1.wasabisys.com',
                'baseUrl' => 'https://akeneo.company.com',
                'clientEmail' => 'service-account@project.iam.gserviceaccount.com',
                'privateKey' => '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
                'accountName' => 'account123',
                'container' => 'images',
                'sasToken' => '?sv=2023-01-03&sr=c&sig=abc123',
                'clientId' => 'akeneo-client-id',
                'clientSecret' => 'akeneo-client-secret',
                'password' => 'strongpassword123',
                'username' => 'integration-user',
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->update(
            'id',
            [
                'accessKey' => 'AKIAIOSFODNN7EXAMPLE',
                'bucket' => 'gcs-media',
                'name' => 'US S3 Storage',
                'secretKey' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY',
                'type' => 'AKENEO_PIM',
                'endpoint' => 'https://s3.eu-central-1.wasabisys.com',
                'baseUrl' => 'https://akeneo.company.com',
                'clientEmail' => 'service-account@project.iam.gserviceaccount.com',
                'privateKey' => '-----BEGIN PRIVATE KEY-----\\nMIIEv...',
                'accountName' => 'account123',
                'container' => 'images',
                'sasToken' => '?sv=2023-01-03&sr=c&sig=abc123',
                'clientId' => 'akeneo-client-id',
                'clientSecret' => 'akeneo-client-secret',
                'password' => 'strongpassword123',
                'username' => 'integration-user',
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->list();

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->delete('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testGet(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->accounts->origins->get('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
