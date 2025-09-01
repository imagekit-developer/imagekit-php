<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Triggered when a new video transformation request is accepted for processing. This event confirms that ImageKit has received and queued your transformation request. Use this for debugging and tracking transformation lifecycle.
 */
final class UnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
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
        ];
    }
}
