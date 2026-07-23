<?php

declare(strict_types=1);

namespace ImageKit\Files\File;

/**
 * Type of the asset.
 */
enum Type: string
{
    case FILE = 'file';

    case FILE_VERSION = 'file-version';
}
