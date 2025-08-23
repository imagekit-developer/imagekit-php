<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

final class ResponseField implements ConverterSource
{
    use SdkEnum;

    public const TAGS = 'tags';

    public const CUSTOM_COORDINATES = 'customCoordinates';

    public const IS_PRIVATE_FILE = 'isPrivateFile';

    public const EMBEDDED_METADATA = 'embeddedMetadata';

    public const IS_PUBLISHED = 'isPublished';

    public const CUSTOM_METADATA = 'customMetadata';

    public const METADATA = 'metadata';
}
