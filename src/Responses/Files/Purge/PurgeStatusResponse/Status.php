<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Purge\PurgeStatusResponse;

use ImageKit\Core\Concerns\Enum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Status of the purge request.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use Enum;

    public const PENDING = 'Pending';

    public const COMPLETED = 'Completed';
}
