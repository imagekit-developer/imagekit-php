<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Triggered when a new video transformation request is accepted for processing. This event confirms that ImageKit has received and queued your transformation request. Use this for debugging and tracking transformation lifecycle.
 *
 * @phpstan-import-type VideoTransformationAcceptedEventShape from \ImageKit\Webhooks\VideoTransformationAcceptedEvent
 * @phpstan-import-type VideoTransformationReadyEventShape from \ImageKit\Webhooks\VideoTransformationReadyEvent
 * @phpstan-import-type VideoTransformationErrorEventShape from \ImageKit\Webhooks\VideoTransformationErrorEvent
 * @phpstan-import-type UploadPreTransformSuccessEventShape from \ImageKit\Webhooks\UploadPreTransformSuccessEvent
 * @phpstan-import-type UploadPreTransformErrorEventShape from \ImageKit\Webhooks\UploadPreTransformErrorEvent
 * @phpstan-import-type UploadPostTransformSuccessEventShape from \ImageKit\Webhooks\UploadPostTransformSuccessEvent
 * @phpstan-import-type UploadPostTransformErrorEventShape from \ImageKit\Webhooks\UploadPostTransformErrorEvent
 * @phpstan-import-type FileCreateEventShape from \ImageKit\Webhooks\FileCreateEvent
 * @phpstan-import-type FileUpdateEventShape from \ImageKit\Webhooks\FileUpdateEvent
 * @phpstan-import-type FileDeleteEventShape from \ImageKit\Webhooks\FileDeleteEvent
 * @phpstan-import-type FileVersionCreateEventShape from \ImageKit\Webhooks\FileVersionCreateEvent
 * @phpstan-import-type FileVersionDeleteEventShape from \ImageKit\Webhooks\FileVersionDeleteEvent
 *
 * @phpstan-type UnsafeUnwrapWebhookEventVariants = VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|FileCreateEvent|FileUpdateEvent|FileDeleteEvent|FileVersionCreateEvent|FileVersionDeleteEvent
 * @phpstan-type UnsafeUnwrapWebhookEventShape = UnsafeUnwrapWebhookEventVariants|VideoTransformationAcceptedEventShape|VideoTransformationReadyEventShape|VideoTransformationErrorEventShape|UploadPreTransformSuccessEventShape|UploadPreTransformErrorEventShape|UploadPostTransformSuccessEventShape|UploadPostTransformErrorEventShape|FileCreateEventShape|FileUpdateEventShape|FileDeleteEventShape|FileVersionCreateEventShape|FileVersionDeleteEventShape
 */
final class UnsafeUnwrapWebhookEvent implements ConverterSource
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
            FileCreateEvent::class,
            FileUpdateEvent::class,
            FileDeleteEvent::class,
            FileVersionCreateEvent::class,
            FileVersionDeleteEvent::class,
        ];
    }
}
