<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadV2Params;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * If set to `true` and a file already exists at the exact location, its AITags will be removed. Set `overwriteAITags` to `false` to preserve AITags.
 *
 * @phpstan-type overwrite_ai_tags_alias = OverwriteAITags::*
 */
final class OverwriteAITags implements ConverterSource
{
    use Enum;

    public const TRUE = 'true';

    public const FALSE = 'false';
}
