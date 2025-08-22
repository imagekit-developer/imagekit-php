<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationAcceptedWebhookEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type format_alias = Format::*
 */
final class Format implements ConverterSource
{
    use SdkEnum;

    public const MP4 = 'mp4';

    public const WEBM = 'webm';

    public const JPG = 'jpg';

    public const PNG = 'png';

    public const WEBP = 'webp';
}
