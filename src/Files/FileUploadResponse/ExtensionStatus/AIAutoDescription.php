<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadResponse\ExtensionStatus;

enum AIAutoDescription: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
