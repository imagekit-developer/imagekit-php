<?php

namespace Tests\Resources;

use ImageKit\Accounts\AccountGetUsageParams;
use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class AccountsTest extends TestCase
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
    public function testGetUsage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AccountGetUsageParams::from(
            endDate: new \DateTimeImmutable('2019-12-27'),
            startDate: new \DateTimeImmutable('2019-12-27'),
        );
        $result = $this->client->accounts->getUsage($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGetUsageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = AccountGetUsageParams::from(
            endDate: new \DateTimeImmutable('2019-12-27'),
            startDate: new \DateTimeImmutable('2019-12-27'),
        );
        $result = $this->client->accounts->getUsage($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
