<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\VideoTransformationReadyEvent\Data\Transformation\Options;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class StreamProtocol implements ConverterSource
{
    use SdkEnum;

    public const HLS = 'HLS';

    public const DASH = 'DASH';
}
