<?php

declare(strict_types=1);

namespace ImageKit\Assets\UploadResponse\ExtensionStatus;

enum AIAutoDescription: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
