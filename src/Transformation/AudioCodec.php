<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Specifies the audio codec, e.g., `aac`, `opus`, or `none`. See [Audio codec](https://imagekit.io/docs/video-optimization#audio-codec---ac).
 */
enum AudioCodec: string
{
    case AAC = 'aac';

    case OPUS = 'opus';

    case NONE = 'none';
}
