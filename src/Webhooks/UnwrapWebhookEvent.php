<?php

declare(strict_types=1);

namespace Imagekit\Webhooks;

use Imagekit\Core\Concerns\SdkUnion;
use Imagekit\Core\Conversion\Contracts\Converter;
use Imagekit\Core\Conversion\Contracts\ConverterSource;

/**
 * Triggered when a new video transformation request is accepted for processing. This event confirms that ImageKit has received and queued your transformation request. Use this for debugging and tracking transformation lifecycle.
 *
 * @phpstan-import-type VideoTransformationAcceptedEventShape from \Imagekit\Webhooks\VideoTransformationAcceptedEvent
 * @phpstan-import-type VideoTransformationReadyEventShape from \Imagekit\Webhooks\VideoTransformationReadyEvent
 * @phpstan-import-type VideoTransformationErrorEventShape from \Imagekit\Webhooks\VideoTransformationErrorEvent
 * @phpstan-import-type UploadPreTransformSuccessEventShape from \Imagekit\Webhooks\UploadPreTransformSuccessEvent
 * @phpstan-import-type UploadPreTransformErrorEventShape from \Imagekit\Webhooks\UploadPreTransformErrorEvent
 * @phpstan-import-type UploadPostTransformSuccessEventShape from \Imagekit\Webhooks\UploadPostTransformSuccessEvent
 * @phpstan-import-type UploadPostTransformErrorEventShape from \Imagekit\Webhooks\UploadPostTransformErrorEvent
 * @phpstan-import-type FileCreatedWebhookEventShape from \Imagekit\Webhooks\FileCreatedWebhookEvent
 * @phpstan-import-type FileUpdatedWebhookEventShape from \Imagekit\Webhooks\FileUpdatedWebhookEvent
 * @phpstan-import-type FileDeletedWebhookEventShape from \Imagekit\Webhooks\FileDeletedWebhookEvent
 * @phpstan-import-type FileVersionCreatedWebhookEventShape from \Imagekit\Webhooks\FileVersionCreatedWebhookEvent
 * @phpstan-import-type FileVersionDeletedWebhookEventShape from \Imagekit\Webhooks\FileVersionDeletedWebhookEvent
 *
 * @phpstan-type UnwrapWebhookEventVariants = VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreatedWebhookEvent|FileUpdatedWebhookEvent|FileDeletedWebhookEvent|FileVersionCreatedWebhookEvent|FileVersionDeletedWebhookEvent
 * @phpstan-type UnwrapWebhookEventShape = UnwrapWebhookEventVariants|VideoTransformationAcceptedEventShape|VideoTransformationReadyEventShape|VideoTransformationErrorEventShape|UploadPreTransformSuccessEventShape|UploadPreTransformErrorEventShape|UploadPostTransformSuccessEventShape|UploadPostTransformErrorEventShape|FileCreatedWebhookEventShape|FileUpdatedWebhookEventShape|FileDeletedWebhookEventShape|FileVersionCreatedWebhookEventShape|FileVersionDeletedWebhookEventShape
 */
final class UnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            VideoTransformationAcceptedEvent::class,
            VideoTransformationReadyEvent::class,
            VideoTransformationErrorEvent::class,
            UploadPreTransformSuccessEvent::class,
            UploadPreTransformErrorEvent::class,
            UploadPostTransformSuccessEvent::class,
            UploadPostTransformErrorEvent::class,
            FileCreatedWebhookEvent::class,
            FileUpdatedWebhookEvent::class,
            FileDeletedWebhookEvent::class,
            FileVersionCreatedWebhookEvent::class,
            FileVersionDeletedWebhookEvent::class,
        ];
    }
}
