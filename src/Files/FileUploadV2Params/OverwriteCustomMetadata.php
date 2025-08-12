<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV2Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * If the request does not have `customMetadata`, and a file already exists at the exact location, existing customMetadata will be removed.
 *
 * @phpstan-type overwrite_custom_metadata_alias = OverwriteCustomMetadata::*
 */
final class OverwriteCustomMetadata implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
