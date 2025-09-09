<?php

declare(strict_types=1);

namespace ImageKit\Webhooks\UploadPreTransformSuccessEvent\Data\ExtensionStatus;

enum AIAutoDescription: string
{
    case SUCCESS = 'success';

    case PENDING = 'pending';

    case FAILED = 'failed';
}
