<?php

namespace Tests\Resources\Beta\V2;

use ImageKit\Beta\V2\Files\FileUploadParams;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming;
use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail;
use ImageKit\Client;
use ImageKit\Shared\AutoTaggingExtension;
use ImageKit\Shared\RemovedotBgExtension;
use ImageKit\Shared\RemovedotBgExtension\Options;
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
            privateAPIKey: 'My Private API Key',
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

        $params = FileUploadParams::with(file: 'file', fileName: 'fileName');
        $result = $this->client->beta->v2->files->upload($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $params = FileUploadParams::with(
            file: 'file',
            fileName: 'fileName',
            token: 'token',
            checks: "\"request.folder\" : \"marketing/\"\n",
            customCoordinates: 'customCoordinates',
            customMetadata: ['brand' => (object) [], 'color' => (object) []],
            description: 'Running shoes',
            extensions: [
                RemovedotBgExtension::with(name: 'remove-bg')
                    ->withOptions(
                        (new Options)
                            ->withAddShadow(true)
                            ->withBgColor('bg_color')
                            ->withBgImageURL('bg_image_url')
                            ->withSemitransparency(true),
                    ),
                AutoTaggingExtension::with(
                    maxTags: 5,
                    minConfidence: 95,
                    name: 'google-auto-tagging'
                ),
            ],
            folder: 'folder',
            isPrivateFile: true,
            isPublished: true,
            overwriteAITags: true,
            overwriteCustomMetadata: true,
            overwriteFile: true,
            overwriteTags: true,
            responseFields: ['tags', 'customCoordinates', 'isPrivateFile'],
            tags: ['t-shirt', 'round-neck', 'men'],
            transformation: (new Transformation)
                ->withPost(
                    [
                        GenerateAThumbnail::with(type: 'thumbnail')->withValue('w-150,h-150'),
                        AdaptiveBitrateStreaming::with(
                            protocol: 'dash',
                            type: 'abs',
                            value: 'sr-240_360_480_720_1080'
                        ),
                    ],
                )
                ->withPre('w-300,h-300,q-80'),
            useUniqueFileName: true,
            webhookURL: 'https://example.com',
        );
        $result = $this->client->beta->v2->files->upload($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
