<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Exceptions\WebhookException;
use ImageKit\Webhooks\FileCreateEvent;
use ImageKit\Webhooks\FileDeleteEvent;
use ImageKit\Webhooks\FileUpdateEvent;
use ImageKit\Webhooks\FileVersionCreateEvent;
use ImageKit\Webhooks\FileVersionDeleteEvent;
use ImageKit\Webhooks\UploadPostTransformErrorEvent;
use ImageKit\Webhooks\UploadPostTransformSuccessEvent;
use ImageKit\Webhooks\UploadPreTransformErrorEvent;
use ImageKit\Webhooks\UploadPreTransformSuccessEvent;
use ImageKit\Webhooks\VideoTransformationAcceptedEvent;
use ImageKit\Webhooks\VideoTransformationErrorEvent;
use ImageKit\Webhooks\VideoTransformationReadyEvent;

interface WebhooksContract
{
    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @throws WebhookException
     */
    public function unsafeUnwrap(
        string $body
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreateEvent|FileUpdateEvent|FileDeleteEvent|FileVersionCreateEvent|FileVersionDeleteEvent;

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
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreateEvent|FileUpdateEvent|FileDeleteEvent|FileVersionCreateEvent|FileVersionDeleteEvent;
}
