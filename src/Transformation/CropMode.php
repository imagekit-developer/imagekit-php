<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

/**
 * Additional crop modes for image resizing. See [Crop modes & focus](https://imagekit.io/docs/image-resize-and-crop#crop-crop-modes--focus).
 */
enum CropMode: string
{
    case PAD_RESIZE = 'pad_resize';

    case EXTRACT = 'extract';

    case PAD_EXTRACT = 'pad_extract';
}
