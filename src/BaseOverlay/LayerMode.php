<?php

declare(strict_types=1);

namespace Imagekit\BaseOverlay;

/**
 * Controls how the layer blends with the base image or underlying content. Maps to `lm` in the URL.
 * By default, layers completely cover the base image beneath them. Layer modes change this behavior:
 * - `multiply`: Multiplies the pixel values of the layer with the base image. The result is always darker than the original images. This is ideal for applying shadows or color tints.
 * - `displace`: Uses the layer as a displacement map to distort pixels in the base image. The red channel controls horizontal displacement, and the green channel controls vertical displacement. Requires `x` or `y` parameter to control displacement magnitude.
 * - `cutout`: Acts as an inverse mask where opaque areas of the layer turn the base image transparent, while transparent areas leave the base image unchanged. This mode functions like a hole-punch, effectively cutting the shape of the layer out of the underlying image.
 * - `cutter`: Acts as a shape mask where only the parts of the base image that fall inside the opaque area of the layer are preserved. This mode functions like a cookie-cutter, trimming the base image to match the specific dimensions and shape of the layer.
 * See [Layer modes](https://imagekit.io/docs/add-overlays-on-images#layer-modes).
 */
enum LayerMode: string
{
    case MULTIPLY = 'multiply';

    case CUTTER = 'cutter';

    case CUTOUT = 'cutout';

    case DISPLACE = 'displace';
}
