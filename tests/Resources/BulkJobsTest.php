<?php

namespace Tests\Resources;

use ImageKit\BulkJobs\BulkJobCopyFolderParams;
use ImageKit\BulkJobs\BulkJobMoveFolderParams;
use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BulkJobsTest extends TestCase
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
    public function testCopyFolder(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkJobCopyFolderParams::from(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->bulkJobs->copyFolder($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCopyFolderWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkJobCopyFolderParams::from(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
            includeVersions: true,
        );
        $result = $this->client->bulkJobs->copyFolder($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveFolder(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkJobMoveFolderParams::from(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->bulkJobs->moveFolder($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testMoveFolderWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = BulkJobMoveFolderParams::from(
            destinationPath: '/path/of/destination/folder',
            sourceFolderPath: '/path/of/source/folder',
        );
        $result = $this->client->bulkJobs->moveFolder($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveStatus(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulkJobs->retrieveStatus('jobId');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
