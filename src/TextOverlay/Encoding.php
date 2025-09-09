<?php

declare(strict_types=1);

namespace ImageKit\TextOverlay;

/**
 * Text can be included in the layer as either `i-{input}` (plain text) or `ie-{base64_encoded_input}` (base64).
 * By default, the SDK selects the appropriate format based on the input text.
 * To always use base64 (`ie-{base64}`), set this parameter to `base64`.
 * To always use plain text (`i-{input}`), set it to `plain`.
 */
enum Encoding: string
{
    case AUTO = 'auto';

    case PLAIN = 'plain';

    case BASE64 = 'base64';
}
