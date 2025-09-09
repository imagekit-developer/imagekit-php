<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
 */
enum Crop: string
{
    case FORCE = 'force';

    case AT_MAX = 'at_max';

    case AT_MAX_ENLARGE = 'at_max_enlarge';

    case AT_LEAST = 'at_least';

    case MAINTAIN_RATIO = 'maintain_ratio';
}
