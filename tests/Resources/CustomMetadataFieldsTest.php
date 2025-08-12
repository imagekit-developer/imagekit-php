<?php

namespace Tests\Resources;

use ImageKit\Client;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldCreateParams\Schema;
use ImageKit\CustomMetadataFields\CustomMetadataFieldListParams;
use ImageKit\CustomMetadataFields\CustomMetadataFieldUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CustomMetadataFieldsTest extends TestCase
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

        $params = CustomMetadataFieldCreateParams::from(
            label: 'price',
            name: 'price',
            schema: Schema::from(type: 'Number')
        );
        $result = $this->client->customMetadataFields->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = CustomMetadataFieldCreateParams::from(
            label: 'price',
            name: 'price',
            schema: Schema::from(type: 'Number')
                ->setDefaultValue('string')
                ->setIsValueRequired(true)
                ->setMaxLength(0)
                ->setMaxValue(3000)
                ->setMinLength(0)
                ->setMinValue(1000)
                ->setSelectOptions(['small', 'medium', 'large', 30, 40, true]),
        );
        $result = $this->client->customMetadataFields->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = (new CustomMetadataFieldUpdateParams);
        $result = $this->client->customMetadataFields->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = (new CustomMetadataFieldListParams);
        $result = $this->client->customMetadataFields->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->customMetadataFields->delete('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
