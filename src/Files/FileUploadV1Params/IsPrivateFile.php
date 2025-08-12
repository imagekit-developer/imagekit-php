<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV1Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Whether to mark the file as private or not.
 *
 * If `true`, the file is marked as private and is accessible only using named transformation or signed URL.
 *
 * @phpstan-type is_private_file_alias = IsPrivateFile::*
 */
final class IsPrivateFile implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
