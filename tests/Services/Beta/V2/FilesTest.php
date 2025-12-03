<?php

namespace Tests\Services\Beta\V2;

use ImageKit\Beta\V2\Files\FileUploadResponse;
use ImageKit\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class FilesTest extends TestCase
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
    public function testUpload(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->beta->v2->files->upload([
            'file' => file_get_contents(__FILE__) ?: '', 'fileName' => 'fileName',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->beta->v2->files->upload([
            'file' => file_get_contents(__FILE__) ?: '',
            'fileName' => 'fileName',
            'token' => 'token',
            'checks' => '"request.folder" : "marketing/"\n',
            'customCoordinates' => 'customCoordinates',
            'customMetadata' => ['brand' => 'bar', 'color' => 'bar'],
            'description' => 'Running shoes',
            'extensions' => [
                [
                    'name' => 'remove-bg',
                    'options' => [
                        'add_shadow' => true,
                        'bg_color' => 'bg_color',
                        'bg_image_url' => 'bg_image_url',
                        'semitransparency' => true,
                    ],
                ],
                [
                    'maxTags' => 5, 'minConfidence' => 95, 'name' => 'google-auto-tagging',
                ],
                ['name' => 'ai-auto-description'],
            ],
            'folder' => 'folder',
            'isPrivateFile' => true,
            'isPublished' => true,
            'overwriteAITags' => true,
            'overwriteCustomMetadata' => true,
            'overwriteFile' => true,
            'overwriteTags' => true,
            'responseFields' => ['tags', 'customCoordinates', 'isPrivateFile'],
            'tags' => ['t-shirt', 'round-neck', 'men'],
            'transformation' => [
                'post' => [
                    ['type' => 'thumbnail', 'value' => 'w-150,h-150'],
                    [
                        'protocol' => 'dash',
                        'type' => 'abs',
                        'value' => 'sr-240_360_480_720_1080',
                    ],
                ],
                'pre' => 'w-300,h-300,q-80',
            ],
            'useUniqueFileName' => true,
            'webhookUrl' => 'https://example.com',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FileUploadResponse::class, $result);
    }
}
