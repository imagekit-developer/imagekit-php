<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV1Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Whether to use a unique filename for this file or not.
 *
 * If `true`, ImageKit.io will add a unique suffix to the filename parameter to get a unique filename.
 *
 * If `false`, then the image is uploaded with the provided filename parameter, and any existing file with the same name is replaced.
 *
 * @phpstan-type use_unique_file_name_alias = UseUniqueFileName::*
 */
final class UseUniqueFileName implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
