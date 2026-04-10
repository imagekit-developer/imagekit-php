<?php

declare(strict_types=1);

namespace Imagekit\ServiceContracts;

use Imagekit\Core\Exceptions\WebhookException;
use Imagekit\Webhooks\DamFileCreateEvent;
use Imagekit\Webhooks\DamFileDeleteEvent;
use Imagekit\Webhooks\DamFileUpdateEvent;
use Imagekit\Webhooks\DamFileVersionCreateEvent;
use Imagekit\Webhooks\DamFileVersionDeleteEvent;
use Imagekit\Webhooks\UploadPostTransformErrorEvent;
use Imagekit\Webhooks\UploadPostTransformSuccessEvent;
use Imagekit\Webhooks\UploadPreTransformErrorEvent;
use Imagekit\Webhooks\UploadPreTransformSuccessEvent;
use Imagekit\Webhooks\VideoTransformationAcceptedEvent;
use Imagekit\Webhooks\VideoTransformationErrorEvent;
use Imagekit\Webhooks\VideoTransformationReadyEvent;

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
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|DamFileCreateEvent|DamFileUpdateEvent|DamFileDeleteEvent|DamFileVersionCreateEvent|DamFileVersionDeleteEvent;

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
    ): VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|DamFileCreateEvent|DamFileUpdateEvent|DamFileDeleteEvent|DamFileVersionCreateEvent|DamFileVersionDeleteEvent;
}
