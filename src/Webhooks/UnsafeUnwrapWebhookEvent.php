<?php

declare(strict_types=1);

namespace ImageKit\Webhooks;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

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
            VideoTransformationAcceptedEvent::class,
            VideoTransformationReadyEvent::class,
            VideoTransformationErrorEvent::class,
        ];
    }
}
