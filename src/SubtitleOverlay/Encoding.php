<?php

declare(strict_types=1);

namespace ImageKit\SubtitleOverlay;

/**
 * The input path can be included in the layer as either `i-{input}` or `ie-{base64_encoded_input}`.
 * By default, the SDK determines the appropriate format automatically.
 * To always use base64 encoding (`ie-{base64}`), set this parameter to `base64`.
 * To always use plain text (`i-{input}`), set it to `plain`.
 *
 * Regardless of the encoding method:
 * - Leading and trailing slashes are removed.
 * - Remaining slashes within the path are replaced with `@@` when using plain text.
 */
enum Encoding: string
{
    case AUTO = 'auto';

    case PLAIN = 'plain';

    case BASE64 = 'base64';
}
