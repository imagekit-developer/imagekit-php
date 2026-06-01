<?php

declare(strict_types=1);

namespace ImageKit\Assets\Jobs\JobGetResponse;

/**
 * Type of the bulk job.
 */
enum Type: string
{
    case COPY_FOLDER = 'COPY_FOLDER';

    case MOVE_FOLDER = 'MOVE_FOLDER';

    case RENAME_FOLDER = 'RENAME_FOLDER';
}
