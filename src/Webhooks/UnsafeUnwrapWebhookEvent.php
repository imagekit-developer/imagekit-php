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
 * @phpstan-import-type FileCreateEventShape from \Imagekit\Webhooks\FileCreateEvent
 * @phpstan-import-type FileUpdateEventShape from \Imagekit\Webhooks\FileUpdateEvent
 * @phpstan-import-type FileDeleteEventShape from \Imagekit\Webhooks\FileDeleteEvent
 * @phpstan-import-type FileVersionCreateEventShape from \Imagekit\Webhooks\FileVersionCreateEvent
 * @phpstan-import-type FileVersionDeleteEventShape from \Imagekit\Webhooks\FileVersionDeleteEvent
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
