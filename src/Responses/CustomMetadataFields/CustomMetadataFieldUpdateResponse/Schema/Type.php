<?php

declare(strict_types=1);

namespace ImageKit\Responses\CustomMetadataFields\CustomMetadataFieldUpdateResponse\Schema;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the custom metadata field.
 *
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const TEXT = 'Text';

    public const TEXTAREA = 'Textarea';

    public const NUMBER = 'Number';

    public const DATE = 'Date';

    public const BOOLEAN = 'Boolean';

    public const SINGLE_SELECT = 'SingleSelect';

    public const MULTI_SELECT = 'MultiSelect';
}
