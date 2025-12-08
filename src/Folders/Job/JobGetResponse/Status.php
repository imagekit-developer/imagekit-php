<?php

declare(strict_types=1);

namespace Imagekit\Folders\Job\JobGetResponse;

/**
 * Status of the bulk job.
 */
enum Status: string
{
    case PENDING = 'Pending';

    case COMPLETED = 'Completed';
}
