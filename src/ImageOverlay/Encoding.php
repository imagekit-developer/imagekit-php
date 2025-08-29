<?php

declare(strict_types=1);

namespace ImageKit\ImageOverlay;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
 * By default, the SDK determines the appropriate format automatically.
 * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
 * To always use plain text (`i-{input}`), set it to `plain`.
 */
final class Encoding implements ConverterSource
{
    use SdkEnum;

    public const AUTO = 'auto';

    public const PLAIN = 'plain';

    public const BASE64 = 'base64';
}
