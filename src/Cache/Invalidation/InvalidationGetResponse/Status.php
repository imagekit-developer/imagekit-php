<?php

declare(strict_types=1);

namespace Imagekit\Cache\Invalidation\InvalidationGetResponse;

/**
 * Status of the purge request.
 */
enum Status: string
{
    case PENDING = 'Pending';

    case COMPLETED = 'Completed';
}
