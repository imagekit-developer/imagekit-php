<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPostTransformErrorEvent\Request\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the requested post-transformation.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const TRANSFORMATION = 'transformation';

    public const ABS = 'abs';

    public const GIF_TO_VIDEO = 'gif-to-video';

    public const THUMBNAIL = 'thumbnail';
}
