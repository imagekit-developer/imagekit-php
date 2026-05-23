<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateResponse\ExtensionStatus;

enum AwsAutoTagging: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
