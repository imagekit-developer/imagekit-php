<?php

namespace Tests\Services;

use ImageKit\Client;
use ImageKit\Core\Exceptions\WebhookException;
use ImageKit\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use StandardWebhooks\Webhook;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends TestCase
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
    public function testUnsafeUnwrap(): void
    {
        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $this->client->webhooks->unsafeUnwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnsafeUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unsafeUnwrap($badPayload);
    }

    #[Test]
    public function testUnwrap(): void
    {
        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $this->client->webhooks->unwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unwrap($badPayload);
    }

    #[Test]
    public function testUnwrapWithVerification(): void
    {
        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapWrongKey(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $wrongKey = 'whsec_aaaaaaaaaa';
        $this->client->webhooks->unwrap($payload, $headers, $wrongKey);
    }

    #[Test]
    public function testUnwrapBadSignature(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $badSig = $webhook->sign($messageId, $timestamp, 'some other payload');

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$badSig],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapOldTimestamp(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => ['5'],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapWrongMessageID(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"id":"id","type":"video.transformation.accepted","created_at":"2019-12-27T18:11:19.117Z","data":{"asset":{"url":"https://example.com"},"transformation":{"type":"video-transformation","options":{"audio_codec":"aac","auto_rotate":true,"format":"mp4","quality":0,"stream_protocol":"HLS","variants":["string"],"video_codec":"h264"}}},"request":{"url":"https://example.com","x_request_id":"x_request_id","user_agent":"user_agent"}}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => ['wrong'],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }
}
