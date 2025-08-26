<?php

declare(strict_types=1);

namespace ImageKit\Cache\Invalidation\InvalidationGetResponse;

use ImageKit\Core\Concerns\SdkEnum;
use ImageKit\Core\Conversion\Contracts\ConverterSource;

/**
 * Status of the purge request.
 */
final class Status implements ConverterSource
{
    use SdkEnum;

    public const PENDING = 'Pending';

    public const COMPLETED = 'Completed';
}
