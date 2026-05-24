<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateResponse\ExtensionStatus;

enum AITasks: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
