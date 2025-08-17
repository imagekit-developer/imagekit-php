<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldListResponseItem\Schema;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the custom metadata field.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const TEXT = 'Text';

    public const TEXTAREA = 'Textarea';

    public const NUMBER = 'Number';

    public const DATE = 'Date';

    public const BOOLEAN = 'Boolean';

    public const SINGLE_SELECT = 'SingleSelect';

    public const MULTI_SELECT = 'MultiSelect';
}
