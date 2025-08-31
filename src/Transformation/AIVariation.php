<?php

declare(strict_types=1);

namespace ImageKit\Transformation;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Generates a variation of an image using AI. This produces a new image with slight variations from the original,
 * such as changes in color, texture, and other visual elements, while preserving the structure and essence of the original image. Not supported inside overlay.
 * See [AI Generate Variations](https://imagekit.io/docs/ai-transformations#generate-variations-of-an-image-e-genvar).
 */
final class AIVariation implements ConverterSource
{
    use SdkEnum;

    public const TRUE = true;
}
