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
 * @phpstan-import-type DamFileCreateEventShape from \Imagekit\Webhooks\DamFileCreateEvent
 * @phpstan-import-type DamFileUpdateEventShape from \Imagekit\Webhooks\DamFileUpdateEvent
 * @phpstan-import-type DamFileDeleteEventShape from \Imagekit\Webhooks\DamFileDeleteEvent
 * @phpstan-import-type DamFileVersionCreateEventShape from \Imagekit\Webhooks\DamFileVersionCreateEvent
 * @phpstan-import-type DamFileVersionDeleteEventShape from \Imagekit\Webhooks\DamFileVersionDeleteEvent
 *
 * @phpstan-type UnsafeUnwrapWebhookEventVariants = VideoTransformationAcceptedEvent|VideoTransformationReadyEvent|VideoTransformationErrorEvent|UploadPreTransformSuccessEvent|UploadPreTransformErrorEvent|UploadPostTransformSuccessEvent|UploadPostTransformErrorEvent|DamFileCreateEvent|DamFileUpdateEvent|DamFileDeleteEvent|DamFileVersionCreateEvent|DamFileVersionDeleteEvent
 * @phpstan-type UnsafeUnwrapWebhookEventShape = UnsafeUnwrapWebhookEventVariants|VideoTransformationAcceptedEventShape|VideoTransformationReadyEventShape|VideoTransformationErrorEventShape|UploadPreTransformSuccessEventShape|UploadPreTransformErrorEventShape|UploadPostTransformSuccessEventShape|UploadPostTransformErrorEventShape|DamFileCreateEventShape|DamFileUpdateEventShape|DamFileDeleteEventShape|DamFileVersionCreateEventShape|DamFileVersionDeleteEventShape
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
            DamFileCreateEvent::class,
            DamFileUpdateEvent::class,
            DamFileDeleteEvent::class,
            DamFileVersionCreateEvent::class,
            DamFileVersionDeleteEvent::class,
        ];
    }
}
