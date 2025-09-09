<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams;

enum ResponseField: string
{
    case TAGS = 'tags';

    case CUSTOM_COORDINATES = 'customCoordinates';

    case IS_PRIVATE_FILE = 'isPrivateFile';

    case EMBEDDED_METADATA = 'embeddedMetadata';

    case IS_PUBLISHED = 'isPublished';

    case CUSTOM_METADATA = 'customMetadata';

    case METADATA = 'metadata';
}
