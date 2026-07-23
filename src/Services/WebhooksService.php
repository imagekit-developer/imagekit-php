<?php

declare(strict_types=1);

namespace ImageKit\Services;

use ImageKit\Client;
use ImageKit\Core\Conversion;
use ImageKit\Core\Exceptions\WebhookException;
use ImageKit\Core\Util;
use ImageKit\ServiceContracts\WebhooksContract;
use ImageKit\Webhooks\FileCreateEvent;
use ImageKit\Webhooks\FileDeleteEvent;
use ImageKit\Webhooks\FileUpdateEvent;
use ImageKit\Webhooks\FileVersionCreateEvent;
use ImageKit\Webhooks\FileVersionDeleteEvent;
use ImageKit\Webhooks\UnsafeUnwrapWebhookEvent;
use ImageKit\Webhooks\UnwrapWebhookEvent;
use ImageKit\Webhooks\UploadPostTransformErrorEvent;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent;
use ImageKit\Webhooks\UploadPreTransformErrorEvent;
use ImageKit\Webhooks\UploadPreTransformSuccessEvent;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent;
use ImageKit\Webhooks\VideoTransformationErrorEvent;
use ImageKit\Webhooks\VideoTransformationReadyEvent;
use StandardWebhooks\Exception\WebhookVerificationException;
use StandardWebhooks\Webhook;

final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @throws WebhookException
     */
    public function unsafeUnwrap(
        string $body
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreateEvent|FileUpdateEvent|FileDeleteEvent|FileVersionCreateEvent|FileVersionDeleteEvent {
        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnsafeUnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @param array<string,string|list<string>>|null $headers
     *
     * @throws WebhookException
     */
    public function unwrap(
        string $body,
        ?array $headers = null,
        ?string $secret = null
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreateEvent|FileUpdateEvent|FileDeleteEvent|FileVersionCreateEvent|FileVersionDeleteEvent {
        if (!is_null($headers)) {
            $secret = $secret ?? ($this->client->webhookSecret ?: null);
            if (is_null($secret)) {
                throw new WebhookException('Webhook key must not be null in order to unwrap');
            }

            try {
                $flatHeaders = array_map(fn (string|array $v): string => is_array($v) ? $v[0] : $v, $headers);
                $webhook = new Webhook($secret);
                $webhook->verify($body, $flatHeaders);
            } catch (WebhookVerificationException $e) {
                throw new WebhookException('Could not verify webhook event signature', previous: $e);
            }
        }

        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }
}
