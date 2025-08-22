<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails;

use ImageKit\Core\Concerns\SdkUnion;
use ImageKit\Core\Conversion\Contracts\Converter;
use ImageKit\Core\Conversion\Contracts\ConverterSource;
use ImageKit\Core\Conversion\ListOf;

/**
 * An array of AITags associated with the file that you want to remove, e.g. `["car", "vehicle", "motorsports"]`.
 *
 * If you want to remove all AITags associated with the file, send a string - "all".
 *
 * Note: The remove operation for `AITags` executes before any of the `extensions` are processed.
 *
 * @phpstan-type remove_ai_tags_alias = string|list<string>
 */
final class RemoveAITags implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [new ListOf('string'), 'string'];
    }
}
