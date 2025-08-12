<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV1Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * If the request does not have `tags`, and a file already exists at the exact location, existing tags will be removed.
 *
 * @phpstan-type overwrite_tags_alias = OverwriteTags::*
 */
final class OverwriteTags implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
