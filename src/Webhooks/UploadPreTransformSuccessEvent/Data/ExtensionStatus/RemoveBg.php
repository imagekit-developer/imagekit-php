<?php

declare(strict_types=1);

namespace Imagekit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus;

enum RemoveBg: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
