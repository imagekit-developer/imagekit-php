<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadResponse\SelectedFieldsSchema;

/**
 * Type of the custom metadata field.
 */
enum Type: string
{
    case TEXT = 'Text';

    case TEXTAREA = 'Textarea';

    case NUMBER = 'Number';

    case DATE = 'Date';

    case BOOLEAN = 'Boolean';

    case SINGLE_SELECT = 'SingleSelect';

    case MULTI_SELECT = 'MultiSelect';
}
