<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type unsafe_unwrap_webhook_event_alias = VideoTransformationAcceptedWebhookEvent|VideoTransformationReadyWebhookEvent|VideoTransformationErrorWebhookEvent
 */
final class UnsafeUnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            VideoTransformationAcceptedWebhookEvent::class,
            VideoTransformationReadyWebhookEvent::class,
            VideoTransformationErrorWebhookEvent::class,
        ];
    }
}
