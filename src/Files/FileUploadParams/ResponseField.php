<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams;

enum ResponseField: string
{
    case TAGS = 'tags';

    case CUSTOM_COORDINATES = 'customCoordinates';

    case IS_PRIVATE_FILE = 'isPrivateFile';

    case EMBEDDED_METADATA = 'embeddedMetadata';

    case IS_PUBLISHED = 'isPublished';

    case CUSTOM_METADATA = 'customMetadata';

    case METADATA = 'metadata';

    case SELECTED_FIELDS_SCHEMA = 'selectedFieldsSchema';
}
