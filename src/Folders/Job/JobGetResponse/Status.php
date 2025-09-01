<?php

declare(strict_types=1);

namespace ImageKit\Folders\Job\JobGetResponse;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Status of the bulk job.
 */
final class Status implements ConverterSource
{
    use SdkEnum;

    public const PENDING = 'Pending';

    public const COMPLETED = 'Completed';
}
