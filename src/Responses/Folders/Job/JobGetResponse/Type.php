<?php

declare(strict_types=1);

namespace ImageKit\Responses\Folders\Job\JobGetResponse;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Type of the bulk job.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const COPY_FOLDER = 'COPY_FOLDER';

    public const MOVE_FOLDER = 'MOVE_FOLDER';

    public const RENAME_FOLDER = 'RENAME_FOLDER';
}
