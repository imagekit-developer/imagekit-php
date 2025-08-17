<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type response_field_alias = ResponseField::*
 */
final class ResponseField implements ConverterSource
{
    use Enum;

    public const TAGS = 'tags';

    public const CUSTOM_COORDINATES = 'customCoordinates';

    public const IS_PRIVATE_FILE = 'isPrivateFile';

    public const EMBEDDED_METADATA = 'embeddedMetadata';

    public const IS_PUBLISHED = 'isPublished';

    public const CUSTOM_METADATA = 'customMetadata';

    public const METADATA = 'metadata';
}
