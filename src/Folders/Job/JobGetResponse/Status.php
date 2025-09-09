<?php

declare(strict_types=1);

namespace ImageKit\Folders\Job\JobGetResponse;

/**
 * Status of the bulk job.
 */
enum Status: string
{
    case PENDING = 'Pending';

    case COMPLETED = 'Completed';
}
