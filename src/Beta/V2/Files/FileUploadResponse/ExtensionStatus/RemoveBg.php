<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadResponse\ExtensionStatus;

enum RemoveBg: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
