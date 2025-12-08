<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUpdateResponse\ExtensionStatus;

enum GoogleAutoTagging: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
